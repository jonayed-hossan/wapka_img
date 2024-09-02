<?php

/*
wapka Image Processing Server
Generate Thumbnail For Any File
Make Thumbnail Size Smaller.
*/

define('DIR_ROOT', __DIR__);
date_default_timezone_set("UTC");
define('TEMP_DIR', "/var/www/app/filemanager/temp_files/"); //temporary file
define('FM_DIR', "/var/www/app/filemanager/wapka_cdn/"); //orginal wapka file
define('IMG_DIR', "/var/www/app/filemanager/wapka_img/"); //thumbnail file

require_once __DIR__ . "/vendor/autoload.php";

ignore_user_abort(true);
set_time_limit(600);

header("WapkaImgProcessor: iRobot");

$CONFIG = [];
$CONFIG['DB_SERVER'] = '89.117.63.148'; //database server IP
$CONFIG['DB_HOST'] = $CONFIG['SERVER_IP'] == $CONFIG['DB_SERVER'] ? 'localhost' : $CONFIG['DB_SERVER'];
$CONFIG['DB_NAME'] = 'wapka_db';
$CONFIG['DB_USER'] = 'admin';
$CONFIG['DB_PASSWORD'] = '8SbFLcxKdaFzQPQU';

$CONFIG['REDIS_SERVER'] = [
	["tcp://89.117.63.148:6379"]
];

if (isset($_REQUEST['fileid'])) {
	$_SERVER['REQUEST_URI'] = '/' . str_pad(base_convert($_REQUEST['fileid'], 10, 36), 6, '0', STR_PAD_LEFT) . '.' . ($_GET['type'] ?? 'jpg');
}

if (!preg_match(
	'~^/(?<id>[\w]{5,10})\.(?<ext>jpg|jpeg|jpe|gif|png|svg|svgz|psd|ps|ico|bmp|tif|tiff|webp|avif)$~',
	parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), // - /(fileid|crc32sum).extention 
	$match
)) {
	http_response_code(404);
	header("ERROR: Invalid Img Link");
	exit(); //invalid image requested
}

if (!is_dir(TEMP_DIR)) {
	@mkdir(TEMP_DIR, 0777, true);
}
if (!is_dir(FM_DIR)) {
	@mkdir(FM_DIR, 0777, true);
}


foreach ([IMG_DIR, FM_DIR, TEMP_DIR] as $dir_name) {
	$img = $dir_name . $match[0];
	if (is_readable($img) && filesize($img) > 0) {
		header("content-type: " . mime_content_type($img));
		readfile($img);
		exit();
	}
}

$redisClient = new \Predis\Client($CONFIG['REDIS_SERVER'][0], ['prefix' => 'wapka_img:']); //connect to redis server

$db = new Mysqlidb(['host' => $CONFIG['DB_HOST'], 'username' => $CONFIG['DB_USER'], 'password' => $CONFIG['DB_PASSWORD'], 'db' => $CONFIG['DB_NAME'], 'charset' => 'utf8mb4']);

$fileKey = $match['id'];
if (strlen($fileKey) <= 6) { //orginal id
	$fileid = base_convert($match['id'], 36, 10);
}

if ($data = $redisClient->get("file_info:" . $fileKey)) {
	$fileInfo = json_decode($data, true);
} else {
	if (isset($fileid)) {
		$db->where('id', $fileid);
	} else { //crc32 sum
		$db->where('thumb', basename($img));
	}
	$fileInfo = $db->getOne('file');
	$redisClient->set("file_info:" . $fileKey, json_encode($fileInfo));
}

if (empty($fileInfo)) { //file not found
	http_response_code(404);
	header("ERROR: File Not Found!");
	exit();
}
//if thumb already exist try to use it
if (!empty($fileInfo['thumb']) && isset($fileid)) {
	if (filter_var($fileInfo['thumb'], FILTER_VALIDATE_URL)) { //custom thumbnail link
		http_response_code(301);
		header("location: " . $fileInfo['thumb']);
		exit();
	} else {
		foreach ([IMG_DIR, FM_DIR, TEMP_DIR] as $dir_name) {
			$img = $dir_name . $fileInfo['thumb'];
			if (is_readable($img) && filesize($img) > 0) {
				header("content-type: " . mime_content_type($img));
				readfile($img);
				exit();
			}
		}
	}
}

if (empty($fileInfo['thumb']) && $thumb = $db->where('sum', $fileInfo['sum'])->where('thumb', "%/%", "not like")->where('thumb', "%.%", "like")->getValue('file', 'thumb')) {
	$db->where('id', $fileInfo['id'])->update('file', ['thumb' => $thumb], 1);
	$fileInfo['thumb'] = $thumb;
	//header("location: " . "/" . $fileInfo['thumb']); //share img from old file
	//exit();
	foreach ([IMG_DIR, FM_DIR, TEMP_DIR] as $dir_name) {
		$img = $dir_name . $fileInfo['thumb'];
		if (is_readable($img) && filesize($img) > 0) {
			header("content-type: " . mime_content_type($img));
			readfile($img);
			exit();
		}
	}
}

//generate new thumbnail
$path = $filepath = FM_DIR . $fileInfo['sum'] . '.dat';

if (!file_exists($filepath) || filesize($filepath) !== $fileInfo['size']) {
	$temp_path = $filepath . time();
	$HttpClient = new \GuzzleHttp\Client(['base_uri' => "https://r2cdn.tgs3.org", 'http_errors' => true]);
	$HttpClient->request('GET', "/wapka_cdn/{$fileInfo['sum']}.dat", [
		'sink' => $temp_path,
		'on_headers' => function (\Psr\Http\Message\ResponseInterface $response) use ($fileInfo) {
			$size = (int) $response->getHeaderLine('Content-Length');
			if ($size > 0 && $size < $fileInfo['size']) {
				throw new \Exception('Invalid File Size!');
			}
		}
	]);

	if (@filesize($temp_path) === $fileInfo['size']) {
		rename($temp_path, $filepath);
	} else {
		@unlink($temp_path);
	}
}

if (!file_exists($filepath) || filesize($filepath) !== $fileInfo['size']) {
	http_response_code(503);
	if (is_writable($filepath)) {
		unlink($filepath); //remove partial file
	}
	sleep(3);
	exit("Currently We can't Process Thumbnail For this file. Try again Later...!"); //return false;
}

$mime =  mime_content_type($filepath);
$imgpath = TEMP_DIR . basename($filepath);
if (!is_executable($ffmpeg = __DIR__ . "/bin/ffmpeg")) { //if static build is runable
	$ffmpeg = "ffmpeg"; //static binary: https://johnvansickle.com/ffmpeg/
}

switch ($type = explode("/", $mime)[0]) {
	case "audio":
		$getID3 = new \getID3;
		$tags = $getID3->analyze($filepath);
		if (isset($tags['comments']['picture']['0']['data']) && file_put_contents($imgpath, $tags['comments']['picture']['0']['data'])) {
			//OK
		} else {
			exec("{$ffmpeg} -i '{$filepath}' {$imgpath}.jpg && mv -v {$imgpath}.jpg {$imgpath}"); //try using ffmpeg
		}
		break;
	case "video":
		exec("{$ffmpeg} -i '{$filepath}' -vf  \"thumbnail,scale=400:400\" -frames:v 1 {$imgpath}.jpg && mv -v {$imgpath}.jpg {$imgpath}");
		break;
	case "image":
		copy($filepath, $imgpath);
		break;
	default:
		header("ERROR: NO Thumb for {$mime}");
		break;
}

if (file_exists($imgpath) && ($imgType = exif_imagetype($imgpath)) !== false) {
	$hash = hash_file('crc32b', $imgpath);
	rename($imgpath, $imgpath = TEMP_DIR . $hash . image_type_to_extension($imgType));
	$img = $imgpath;
	$imgData = ['thumb' => basename($imgpath), 'mime' => $mime];
} else {
	$imgData = ['thumb' => "https://telegra.ph/file/a8e2d0f4b190f77a9e59f.jpg", 'mime' => $mime]; //thumb not found so set default img
}

if ($imgData) {
	$db->where('id', $fileInfo['id'])->update('file', $imgData, 1);
}

if ($img && file_exists($img)) {
	header('Content-type: ' . mime_content_type($img));
	header('Content-Length: ' . filesize($img));
	header("Content-Disposition: inline; filename=\"{$fileInfo['name']}.jpg\"");
	readfile($img);
} else {
	header("location: https://telegra.ph/file/a8e2d0f4b190f77a9e59f.jpg");
}
