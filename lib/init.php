<?php
//wapka img.wapka.io img.wapka.org sites
return false;
$default = '/home/wapka/wk_pro/scriptx/wapka_img/lib/default.jpg';
header('Content-type: image/jpg');
if($_SERVER['REQUEST_URI'] == '/default_img.jpg'){
readfile($default);
}elseif (preg_match('~^/(?<id>[a-z0-9]{5,6})\.(?<ext>jpg|jpeg|jpe|gif|png|svg|svgz|psd|ps|ico|bmp|tif|tiff)$~',
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $m)) {
    $fileid = base_convert($m['id'], 36, 10);
if ($fileid && $path = getImgPath($fileid, $m['id'].".jpg")) {
	header('Content-Length: ' . filesize($path));
    #header("Content-Disposition: inline; filename=\"{$file['name']}.jpg\"");
    //header("X-Sendfile: {$path}");
	readfile($path);
}
}else{
http_response_code(404);
readfile($default);
}

function getImgPath($fileid, $filename) {
if(!file_exists($path = '/home/wapka/wapka_img/' . $fileid . '.jpg')){
//curl -H 'host: storage.stook.bid' 162.255.116.72/wapka_img/{$fileid} -o {$path} || 
exec("curl -H 'host: img.wapka.org' 162.255.116.72/{$filename} -o {$path}");
}
if(!file_exists($path)){
header('location: /default_img.jpg');
exit();
}
return $path;
}
