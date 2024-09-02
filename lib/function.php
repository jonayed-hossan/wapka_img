<?php

//error report
register_shutdown_function(function () {
    $error = error_get_last();
    //report only core/faltal error
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_RECOVERABLE_ERROR])) {
        telegram(sprintf("Error: %s\r\nREF: %s\r\nFile: %s\r\nLine:%s", $error['message'], $_SERVER['HTTP_REFERER'] ?? null, $error['file'], $error['line']));
    }
});

function display_download_page($file, $fileid, $token) {
    echo '<!DOCTYPE html><head><title>Free download ' . $file['name'] . ' - Wapka</title>
<meta name="description" content="Free download ' . htmlspecialchars($file['name']) . '" />
    <meta name="keywords" content="' . htmlspecialchars($file['name']) . '" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>body{background-color:transparent!important}body{padding:0;margin:0}header .logo{width:100%;max-height:300px}main{margin-top:30px;margin-bottom:20px}main>.content{width:100%;text-align:center}main>.content>p{color:#a9a9a9}main>.content>h1{font-size:18px;color:inherit;font-weight:500}main>.content>h1>a{color:#6495ed}main>.download{text-align:center}main>.download>p{color:#a9a9a9}main>.download>a.btn-fast-download{text-decoration:none;background-color:#c72000;color:#fff;padding:5px 20px;border:none}footer{bottom:20px;width:100%}footer>#promote-links{display:block;width:100%;text-align:center;padding:0;margin:0}.dl-result #dlbuttons{display:inline-block}.dl-result .download-result{text-align:center}.audio,.video{color:#fff;width:90px;padding:5px;margin:5px;font-size:17px;font-family:monospace;border:#fff solid 1px;color:#fff;border-radius:5px;text-align:center;text-shadow:1px 1px 1px #000;box-shadow:0 0 5px -1px rgba(0,0,0,.75)}.audio:hover,.video:hover,.audio:active,.video:active,.audio:focus,.video:focus{color:#fff}.btn-fps{font-size:14px;font-family:monospace}.video .btn-line,.dl-result .audio .btn-line{border-bottom:1px dashed #fff;margin:5px 0}.video .btn-filesize,.dl-result .audio .btn-filesize{font-size:14px}.video .btn-filetype,.dl-result .audio .btn-filetype{font-size:18px;text-transform:uppercase}.dl-result .audio .btn-quality{font-size:14px}.dl-result .audio .btn-codec{font-size:12px}.dl-result .q2160p{background:#127a48}.dl-result .q1440p{background:#148951}.dl-result .q1080p{background:#17995b}.dl-result .q720p{background:#1baf68}.dl-result .q480p{background:#f29f00}.dl-result .q360p{background:#f26200}.dl-result .q240p{background:#f23d00}.dl-result .q144p{background:#d900a4}.dl-result .q320{background:#127a48}.dl-result .q256{background:#148951}.dl-result .q192{background:#17995b}.dl-result .q160{background:#f29f00}.dl-result .q128{background:#f29f00}.dl-result .q64{background:#f23d00}.dl-result .q48{background:#d900a4}h5{font-weight:800;font-family:monospace;font-size:15px}#stlove143 *{box-sizing:content-box!important}#stlove143 a{display:inline-block!important;vertical-align:top;padding:0;margin:0}#stlove143 a img{display:inline-block!important}#stlove143 ._xt_ad_close,#stlove143 ._xt_ad_close_internal{display:inline-block!important;position:absolute!important;right:6px!important;width:20px!important;height:20px!important;cursor:pointer}#stlove143 ._xt_ad_close{top:-10px!important}#stlove143 ._xt_ad_close_internal{border:6px solid transparent;top:-12px!important;right:3px!important}#alove143{display:inline-block!important;position:relative!important;text-align:left!important;visibility:visible!important;max-width:100%!important;max-height:none!important;z-index:999999!important;z-index:999999999!important}#alove143 img{max-width:none!important;max-height:none!important;width:300px!important;height:50px!important;min-width:0!important;min-height:0!important}.fbalove143{color:#1d1eeb!important;background-color:#fff!important;padding:10px 50px 10px 10px!important;border:1px solid #2c2c2c!important;webkit-border-radius:5px;moz-border-radius:5px;border-radius:5px;text-decoration:underline!important;font-weight:700!important;display:block!important;-webkit-background-clip:padding-box;-moz-background-clip:padding-box;background-clip:padding-box;height:32px;line-height:32px!important;background-image:url(https://github.com/wapkiz/cdn/raw/master/image/arrow.gif)!important;background-repeat:no-repeat!important;background-position:95% center!important}.fbplove143{position:relative!important;display:block!important;width:320px!important;height:50px!important;text-align:left!important;background-color:#fff!important;-moz-box-shadow:0 0 5px rgba(0,0,0,.2);-webkit-box-shadow:0 0 5px rgba(0,0,0,.2);box-shadow:0 0 5px rgba(0,0,0,.2);padding:3px!important;border-radius:3px!important;border:1px solid #6bc135!important;text-decoration:underline!important}.fbp_txtlove143{position:relative!important;display:inline-block!important;min-width:200px;max-width:200px;height:50px!important;vertical-align:top!important;line-height:50px!important;margin-left:6px!important;text-align:left!important;color:#0274d4!important;font-family:Helvetica,Arial,sans-serif!important;font-size:13px!important;font-weight:700!important;text-decoration:underline!important}.fbp_icolove143{position:absolute!important;right:10px!important;height:50px!important;line-height:46px!important;vertical-align:top!important;color:#6bc135!important}#stlove143 .rolling_ad{display:none!important}#stlove143 .rolling_ad.roll_on{display:inline-block!important}</style>
<style>.btnse1 {
color: white;
padding: 12px 30px;
cursor: pointer;
font-size: 20px;
position: absolute;
margin: 100px 0px 0px -105px;
}
.bdr1{border: double;
background-color: #de407a;
	 border-radius: 5px;}
.bdr2{
	border: dashed;
	background-color: #4ebb46;
	 border-radius: 5px;
}
.bdr3{
	border: dotted;
	background-color: #e87253;
	 border-radius: 5px;
}
.bdr4{
	border: solid;
	background-color: #beac13;
	 border-radius: 5px;
}
</style><script async src="https://www.googletagmanager.com/gtag/js?id=UA-177869010-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());
  gtag(\'config\', \'UA-177869010-1\');
  
  document.addEventListener("contextmenu", function(e){
      e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
      // "I" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        disabledEvent(e);
      }
      // "J" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        disabledEvent(e);
      }
      // "S" key + macOS
      if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        disabledEvent(e);
      }
      // "U" key
      if (e.ctrlKey && e.keyCode == 85) {
        disabledEvent(e);
      }
      // "F12" key
      if (event.keyCode == 123) {
        disabledEvent(e);
      }
    }, false);
    function disabledEvent(e){
      if (e.stopPropagation){
        e.stopPropagation();
      } else if (window.event){
        window.event.cancelBubble = true;
      }
      e.preventDefault();
      return false;
    }
  </script>
</head><body>';
    $link1 = $link2 = $link4 = $link5 = 'https://search.wapka.' . (['site', 'co', 'website', 'xyz'][mt_rand(0, 3)]) . '/latest-itemes/?q=most-popular&order=asc';
    $link3 = 'https://sp.popcash.net/go/186280/579691';
    //$link5 = '/search.php';
    //$link4 = 'https://file.wapka.org/search.php';
    $link = 'https://cdn.wapka.io/' . $fileid . '/' . $file['sum'] . '/' . $token . '/' .
            (empty($file['name']) ? 'no_name' : url_slug($file['name'])) . '.' . $file['type'];

//echo "<script>(function(d){let s=d.createElement('script');s.async=true;s.src='https://sntjim.com/code/native.js?h=waWQiOjEwNjQ1OTksInNpZCI6MTA2OTI5OCwid2lkIjoxMzkwODcsInNyYyI6Mn0=eyJ';d.head.appendChild(s);})(document);</script>";
//print "<script type=\"text/javascript\">var b_tag = document.createElement('script');b_tag.src='https://www.bitcoadz.io/display/items.php?46985&52193&0&0&9'; b_tag.async=1; document.body.appendChild(b_tag);</script>";
    print '
      <header>
      <center><iframe scrolling="no" style="height:270px;"  class="lazyload"  data-src="' . $link1 . '"  frameborder="0" marginheight="0" marginwidth="0"  replaced="true"></iframe>
      <div style="width:300px;clear:both;"><div id="sam">
      <button class="btnse1 bdr2">Download Now</button>
      <center><div style="height:250px; width:100%; opacity:0.0002; position: relative;">
      <iframe scrolling="no" style="height:270px;"  class="lazyload"  data-src="' . $link2 . '"  frameborder="0" marginheight="0" marginwidth="0"  replaced="true"></iframe></div></center></div></div>
      </center>
      </header>';

    echo '<main>
		<center><div style="clear:both;">Your file - <i>' . htmlspecialchars($file['name']) . '</i> is ready to download.</div><br/><br/><center>
<a style="clear:both; color: white;
padding: 12px 32px;
cursor: pointer;
font-size: 20px;
border: double;
background-color: #70123d;
border-radius: 5px;
text-decoration-line: none;" href="' . $link . '" rel="nofollow"><i class="fa fa-download"></i>Download file ' . (
    round($file['size'] / pow(1024, ($i = floor(log($file['size'], 1024)))), 2) . [" B", " KB", " MB", " GB", " TB"][$i]
    ) . '</a></center></center><div class="content">  
      </div><br/>
      <div class="download">
      <a href="' . $link3 . '" id="adr" rel="nofollow" target="_blank"  class="btn-fast-download"><i class="fa fa-external-link"></i>Click here</a>
      <p>(Download more content for free)</p>
      </div>
      <center><div style="width:300px;clear:both;"><div id="sam" style="">
      <button class="btnse1 bdr4" ><i class="fa fa-download"></i>Free download</button>
      <center><div style="height:250px; width:100%; opacity:0.0002; position: relative;">
      <iframe scrolling="no" style="height:270px;"  class="lazyload"  data-src="' . $link4 . '"  frameborder="0" marginheight="0" marginwidth="0"  replaced="true"></iframe></div></center></div></div></center>
      <center><div style="width:300px;clear:both;"><div id="sam">
      <button class="bdr1" style="color: white;
      padding: 12px 30px;
      cursor: pointer;
      font-size: 20px;
      position: absolute;
      margin: 33px 0px 0px -105px;" ><i class="fa fa-download"></i>Fast Download</button>
      <center><div style="height:100px; width:100%; opacity:0.0002; position: relative;">
      <iframe scrolling="no" style="height:80px;"  class="lazyload"  data-src="' . $link5 . '"  frameborder="0" marginheight="0" marginwidth="0"  replaced="true"></iframe></div></center></div></div></center>
      <br/><br/>
      </div><script src="https://cdn.wapka.org/003qgl/45bacd312d5098b4b59f563d8756c15d/lazysizes-min.js"></script>
                    </main>';
    //echo '<script async src="//adstook.com/fcdn.js"></script>';
    echo '<footer><center><a href="https://wapka.org/page/contact">Report abuse!</a>
      <br/><a href="https://wapka.org" rel="nofollow">Wapka.org free website builder.</a></center></footer>
      </body></html>';
}


function not_found() {
    http_response_code(404);
    exit('<!DOCTYPE html><html>
    <head><meta charset=UTF-8><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>404 Not Found</title>
    <style>body{font-family:Arial,Helvetica,sans-serif}</style>
    </head>
    <body><center><h1>404 Not Found</h1>
    <h2>The requested content was not found on this site.</h2><br/><a href="https://wapka.org" rel="nofollow">Home</a></center>
</body></html>');
}

function server_busy() {
    global $file;
    telegram(var_export(['server busy', $file], true));
    http_response_code(503);
    header('Retry-After: 100');
    exit('<!DOCTYPE html><html><head><meta charset=UTF-8><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>503 - Server Busy!</title><style>body{font-family:Arial,Helvetica,sans-serif}</style></head><body><center>
    <h1>Server Busy</h1><h2>Please wait a minute and try again!</h2></center></body></html>');
}
//send notification using talegram bot
function telegram($msg) {
    $telegrambot = '1481061205:AAFQqvcNmm3vIgFb2SYVQxoQCczGTHlgvcw';
    $telegramchatid = 1139600909;
    $url = 'https://api.telegram.org/bot' . $telegrambot . '/sendMessage';
    $data = array('chat_id' => $telegramchatid, 'text' => $msg);
    $options = array('http' => array('method' => 'POST', 'header' => "Content-Type:application/x-www-form-urlencoded\r\n", 'content' => http_build_query($data),),);
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
function get_telegram_file() {
    #return false;
    global $file, $db, $path;
    if (!empty($file['tg_bot1'])) {
        $start = microtime(true);
        $res = file_get_contents('http://localhost:8081/bot1864543313:AAFrMVeLxj_imt9Pt8iNrZKDDy8xU-VxUBA/getFile?file_id=' . $file['tg_bot1']);
        $data = json_decode($res, true);
        if (!empty($data['ok']) && isset($data['result']['file_path']) && file_exists($data['result']['file_path'])) {
            #file_put_contents('/home/wapka/public_html/tg.txt', $data['result']['file_path'] . PHP_EOL, FILE_APPEND | LOCK_EX);
            rename($data['result']['file_path'], $path);
        }
        if ($success = file_exists($path) && filesize($path)) {
            header('cdn-server: TG');
            /* @telegram(var_export(['query' => $res, 'speed' => microtime(true) - $start, 'url' => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 
              'ip' => get_ip(), 'ua' => $_SERVER['HTTP_USER_AGENT'], 'ref' => $_SERVER['HTTP_REFERER']], true)); */
        }
        /* $db->insert('sqlquery', ['query' => $res, 'time' => (int) $success, 'speed' => microtime(true) - $start, 'path' => $path, 'siteid' => 0, 'userid' => 0,
          'url' => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'ip' => get_ip(), 'ua' => $_SERVER['HTTP_USER_AGENT'], 'ref' => $_SERVER['HTTP_REFERER']]); */
        return $success;
    }
}

function get_server_file() {
    global $file, $path, $isimg, $m;
    if (true && $file['size'] > 1024 * 1024 * 10 && !$isimg) { //if not img then redirect to file server
        if ($file['server'] == 1 || $file['server'] == 2 || $file['server'] == 3) {
            $link = 'https://cdn' . $file['server'] . '.wapka.io/' . $m['id'] . '/' . $file['sum'] . '/' . sha1(date('W')) . '/' .
                    (empty($file['name']) ? 'no_name' : url_slug($file['name'])) . '.' . $file['type'];
            exit(header('location: ' . $link));
        }
    }
    set_time_limit(0);
    ini_set('memory_limit', '300M');
    if ($file['server'] == 2) { //file storage server 1
        $server = ['name' => '173.249.46.149', 'user' => 'wapka', 'pass' => 'Anuara14', 'path' => '/filemanager/'];
    } elseif ($file['server'] == 3) { //db server as storage
        $server = ['name' => '173.249.29.133', 'user' => 'wapka', 'pass' => 'Anuara14', 'path' => '/filemanager/'];
    } else { //main server
        $server = ['name' => '173.212.225.42', 'user' => 'wapka', 'pass' => '2hOMQL5FZBLvxFf', 'path' => '/filemanager/'];
    }
    if (($conn = ftp_connect($server['name'])) || (sleep(5) === 0 && $conn = ftp_connect($server['name']))) {
        $login = ftp_login($conn, $server['user'], $server['pass']);
        ftp_pasv($conn, true);
        if (ftp_get($conn, $path, $server['path'] . $file['sum'] . '.dat', FTP_BINARY)) {
            //success
            header('cdn-server: WK' . $file['server']);
        }
        ftp_close($conn);
        return file_exists($path);
    }
}

function get_file_thumb() {
    return false;
    global $file, $db;
    if ($thumb = $db->where('sum', $file['thumb'])->getOne('thumb')) {
        if ($thumb['onedrive'] && file_exists('/home/wapka/onedrive/images/' . $file['thumb'] . '.dat')) {
            return '/home/wapka/onedrive/images/' . $file['thumb'] . '.dat';
        } elseif ($thumb['drive'] && file_exists('/home/wapka/drive/images/' . $file['thumb'] . '.dat')) {
            return '/home/wapka/drive/images/' . $file['thumb'] . '.dat';
        } elseif ($thumb['tg_bot1']) {
            $data = json_decode(file_get_contents('http://localhost:8081/bot1944382820:AAGMgmgRTsekEdvDu5o-PMoScuH4RripavI/getFile?file_id=' . $thumb['tg_bot1']), true);
            if (!empty($data['ok']) && isset($data['result']['file_path'])) {
                return $data['result']['file_path'];
            }
        }
    }
}

function make_file_thumb() {
    global $file, $path, $db;
    $category = (function ($ext) {
                if (in_array($ext, ['aif', 'cda', 'mid', 'midi', 'mp3', 'mpa', 'ogg', 'wav', 'wma', 'wpl'])) {
                    return 'audio';
                } elseif (in_array($ext, ['jpg', 'jpeg', 'jpe', 'gif', 'png', 'svg', 'svgz', 'psd', 'ps', 'ico', 'bmp', 'tif', 'tiff'])) {
                    return 'image';
                } elseif (in_array($ext, ['mov', '3gp', 'avi', 'flv', 'h264', 'mpv', 'mkv', 'mpg', 'mpeg', 'mp4', 'rm', 'swf', 'wmv'])) {
                    return 'video';
                } elseif (in_array($ext, ['zip', '7z', 'rar', 'z', 'tar'])) {
                    return 'archive';
                } elseif (in_array($ext, ['htm', 'html', 'xhtml', 'css', 'js', 'xml', 'json', 'ini', 'csv', 'php', 'rss', 'atom', 'txt', 'text'])) {
                    return 'text';
                } else {
                    return 'other';
                }
            })($file['type']);
    if ($category == 'image') {
        return $path;
    } else {
        $imgpath = '/home/wapka/images/' . $file['sum'] . '.dat';
        if (file_exists($imgpath)) {
            //found
            if ($file['thumb'] && rename($imgpath, '/home/wapka/images/' . $file['thumb'] . '.dat')) {
                $imgpath = '/home/wapka/images/' . $file['thumb'] . '.dat';
            }
        } elseif ($category == 'audio') { //audio
            require 'getid3/getid3.php';
            $mp3 = new getID3;
            $info = $mp3->analyze($path);
            if (!empty($mp3->info['id3v2']['APIC']['0']['data'])) {
                file_put_contents($imgpath, $mp3->info['id3v2']['APIC']['0']['data'], LOCK_EX);
            }
        } elseif ($category == 'video') {
            $tp = '/home/wapka/images/' . $file['sum'] . '.jpg'; //temporary path
            //exec("ffmpeg -ss 10 -t 3 -i {$path} -vf \"fps=10,scale=320:-1:flags=lanczos,split[s0][s1];[s0]palettegen[p];[s1][p]paletteuse\" -loop 0 {$file['sum']}.gif");
            exec('ffmpeg -i ' . $path . ' -vf  "thumbnail,scale=320:240" -frames:v 1 ' . $tp . ' && mv ' . $tp . ' ' . $imgpath);
        }
        if (!file_exists($imgpath)) {
            file_put_contents($imgpath, base64_decode('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'));
        }
        //cache file thumb if thumb not exist
        if (empty($file['thumb']) && $newsum = md5_file($imgpath)) {
            if ($db->where('sum', $file['sum'])->update('file_info', ['thumb' => $newsum], 1)) {
                $newpath = str_replace($file['sum'], $newsum, $imgpath);
                if (rename($imgpath, $newpath)) { //if not same file
                    $imgpath = $newpath;
                    if ($size = filesize($imgpath)) {
                        $db->setQueryOption('IGNORE')->insert('thumb', ['sum' => $newsum, 'size' => $size]);
                    }
                    //shell_exec('php /home/wapka/public_html/lib/tg_upload_img.php path=' . $imgpath . ' sum=' . $newsum . ' > /dev/null &');
                }
            }
        }
        return $imgpath;
    }
}

/* function delete_old_file($skip = null){
  //if 100GB useed then remove
  $used = preg_replace('/^(\d+)G.+/','\1', shell_exec('du /home/wapka/public_html/filemanager/ -sh'), 1, $count);
  if($count && $used >= 110){
  $free = 0; //how many file deleted
  foreach(['other', 'video', 'audio', 'archive', 'text', 'image'] as $p){
  $dir = opendir("/home/wapka/public_html/filemanager/{$p}");
  while (($file = readdir($dir)) !== false) {
  if ($file != "." && $file != ".." && $file != $skip && file_exists("/home/wapka/public_html/filemanager/{$p}/{$file}")) {
  if(time() - fileatime("/home/wapka/public_html/filemanager/{$p}/{$file}") > 60 * 60 * 3){ //not accesed on last 3 hours
  if(($size = filesize("/home/wapka/public_html/filemanager/{$p}/{$file}")) && unlink("/home/wapka/public_html/filemanager/{$p}/{$file}")){
  $free += $size;
  //echo $file.date('c', filectime("filemanager/{$p}/{$file}")).PHP_EOL;
  if($free >= 1024 * 1024 * 1024){ //delete
  return $free;
  }
  }
  }
  }
  }
  closedir($dir);
  }
  }} */

function get_ip() {
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
        if (isset($_SERVER[$key]) && filter_var($_SERVER[$key], FILTER_VALIDATE_IP)) {
            return $_SERVER[$key];
        }
    }
    return null;
}

function get_file_category($ext) {
    if (in_array($ext, ['aif', 'cda', 'mid', 'midi', 'mp3', 'mpa', 'ogg', 'wav', 'wma', 'wpl'])) {
        return 'audio';
    } elseif (in_array($ext, ['jpg', 'jpeg', 'jpe', 'gif', 'png', 'svg', 'svgz', 'psd', 'ps', 'ico', 'bmp', 'tif', 'tiff'])) {
        return 'image';
    } elseif (in_array($ext, ['mov', '3gp', 'avi', 'flv', 'h264', 'mpv', 'mkv', 'mpg', 'mpeg', 'mp4', 'rm', 'swf', 'wmv'])) {
        return 'video';
    } elseif (in_array($ext, ['zip', '7z', 'rar', 'z', 'tar'])) {
        return 'archive';
    } elseif (in_array($ext, ['htm', 'html', 'xhtml', 'css', 'js', 'xml', 'json', 'ini', 'csv', 'php', 'rss', 'atom', 'txt', 'text'])) {
        return 'text';
    } else {
        return 'other';
    }
}

//taken from wordpress url slug helper
function utf8_uri_encode($utf8_string, $length = 0) {
    $unicode = '';
    $values = array();
    $num_octets = 1;
    $unicode_length = 0;

    $string_length = strlen($utf8_string);
    for ($i = 0; $i < $string_length; $i++) {

        $value = ord($utf8_string[$i]);

        if ($value < 128) {
            if ($length && ( $unicode_length >= $length ))
                break;
            $unicode .= chr($value);
            $unicode_length++;
        } else {
            if (count($values) == 0)
                $num_octets = ( $value < 224 ) ? 2 : 3;

            $values[] = $value;

            if ($length && ( $unicode_length + ($num_octets * 3) ) > $length)
                break;
            if (count($values) == $num_octets) {
                if ($num_octets == 3) {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                    $unicode_length += 9;
                } else {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                    $unicode_length += 6;
                }

                $values = array();
                $num_octets = 1;
            }
        }
    }

    return $unicode;
}

//taken from wordpress
function seems_utf8($str) {
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80)
            $n = 0;# 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0)
            $n = 1;# 110bbbbb
        elseif (($c & 0xF0) == 0xE0)
            $n = 2;# 1110bbbb
        elseif (($c & 0xF8) == 0xF0)
            $n = 3;# 11110bbb
        elseif (($c & 0xFC) == 0xF8)
            $n = 4;# 111110bb
        elseif (($c & 0xFE) == 0xFC)
            $n = 5;# 1111110b
        else
            return false;# Does not match any model
        for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
            if (( ++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}

//make url slug
function url_slug($url, $length = 1000) {
    $url = strip_tags($url);
    // Preserve escaped octets.
    $url = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $url);
    // Remove percent signs that are not part of an octet.
    $url = str_replace('%', '', $url);
    // Restore octets.
    $url = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $url);

    if (seems_utf8($url)) {
        $url = mb_strtolower($url, 'UTF-8');
        $url = utf8_uri_encode($url, $length);
    } else {
        $url = strtolower($url);
    }
    $url = preg_replace('/&.+?;/', '', $url); // kill entities
    $url = str_replace('.', '-', $url);
    $url = preg_replace('/[^%a-z0-9 _-]/', '', $url);
    $url = preg_replace('/\s+/', '-', $url);
    $url = preg_replace('~(-|_)+~', '$1', $url);
    $url = trim($url, '-_');

    return urldecode($url);
}

function filename($name) {
    $name = preg_replace('~
        [<>:"/\\|?*]|            # file system reserved
        [\x00-\x1F]|             # control characters
        [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
        ~x', '', $name);
    $name = preg_replace(['/ +/', '/_+/', '/-+/', '/\.+/'], [' ', '_', '-', '.'], $name);
    return trim($name, ' .-');
}

function get_file_mime($ext) {
    foreach (array(
'application/andrew-inset' =>
 array(
    0 => 'ez',
),
 'application/applixware' =>
 array(
    0 => 'aw',
),
 'application/atom+xml' =>
 array(
    0 => 'atom',
),
 'application/atomcat+xml' =>
 array(
    0 => 'atomcat',
),
 'application/atomsvc+xml' =>
 array(
    0 => 'atomsvc',
),
 'application/ccxml+xml' =>
 array(
    0 => 'ccxml',
),
 'application/cdmi-capability' =>
 array(
    0 => 'cdmia',
),
 'application/cdmi-container' =>
 array(
    0 => 'cdmic',
),
 'application/cdmi-domain' =>
 array(
    0 => 'cdmid',
),
 'application/cdmi-object' =>
 array(
    0 => 'cdmio',
),
 'application/cdmi-queue' =>
 array(
    0 => 'cdmiq',
),
 'application/cu-seeme' =>
 array(
    0 => 'cu',
),
 'application/davmount+xml' =>
 array(
    0 => 'davmount',
),
 'application/docbook+xml' =>
 array(
    0 => 'dbk',
),
 'application/dssc+der' =>
 array(
    0 => 'dssc',
),
 'application/dssc+xml' =>
 array(
    0 => 'xdssc',
),
 'application/ecmascript' =>
 array(
    0 => 'ecma',
),
 'application/emma+xml' =>
 array(
    0 => 'emma',
),
 'application/epub+zip' =>
 array(
    0 => 'epub',
),
 'application/exi' =>
 array(
    0 => 'exi',
),
 'application/font-tdpfr' =>
 array(
    0 => 'pfr',
),
 'application/gml+xml' =>
 array(
    0 => 'gml',
),
 'application/gpx+xml' =>
 array(
    0 => 'gpx',
),
 'application/gxf' =>
 array(
    0 => 'gxf',
),
 'application/hyperstudio' =>
 array(
    0 => 'stk',
),
 'application/inkml+xml' =>
 array(
    0 => 'ink',
    1 => 'inkml',
),
 'application/ipfix' =>
 array(
    0 => 'ipfix',
),
 'application/java-archive' =>
 array(
    0 => 'jar',
),
 'application/java-serialized-object' =>
 array(
    0 => 'ser',
),
 'application/java-vm' =>
 array(
    0 => 'class',
),
 'application/javascript' =>
 array(
    0 => 'js',
),
 'application/json' =>
 array(
    0 => 'json',
),
 'application/jsonml+json' =>
 array(
    0 => 'jsonml',
),
 'application/lost+xml' =>
 array(
    0 => 'lostxml',
),
 'application/mac-binhex40' =>
 array(
    0 => 'hqx',
),
 'application/mac-compactpro' =>
 array(
    0 => 'cpt',
),
 'application/mads+xml' =>
 array(
    0 => 'mads',
),
 'application/marc' =>
 array(
    0 => 'mrc',
),
 'application/marcxml+xml' =>
 array(
    0 => 'mrcx',
),
 'application/mathematica' =>
 array(
    0 => 'ma',
    1 => 'nb',
    2 => 'mb',
),
 'application/mathml+xml' =>
 array(
    0 => 'mathml',
),
 'application/mbox' =>
 array(
    0 => 'mbox',
),
 'application/mediaservercontrol+xml' =>
 array(
    0 => 'mscml',
),
 'application/metalink+xml' =>
 array(
    0 => 'metalink',
),
 'application/metalink4+xml' =>
 array(
    0 => 'meta4',
),
 'application/mets+xml' =>
 array(
    0 => 'mets',
),
 'application/mods+xml' =>
 array(
    0 => 'mods',
),
 'application/mp21' =>
 array(
    0 => 'm21',
    1 => 'mp21',
),
 'application/mp4' =>
 array(
    0 => 'mp4s',
),
 'application/msword' =>
 array(
    0 => 'doc',
    1 => 'dot',
),
 'application/mxf' =>
 array(
    0 => 'mxf',
),
 'application/octet-stream' =>
 array(
    0 => 'bin',
    1 => 'dms',
    2 => 'lrf',
    3 => 'mar',
    4 => 'so',
    5 => 'dist',
    6 => 'distz',
    7 => 'pkg',
    8 => 'bpk',
    9 => 'dump',
    10 => 'elc',
    11 => 'deploy',
),
 'application/oda' =>
 array(
    0 => 'oda',
),
 'application/oebps-package+xml' =>
 array(
    0 => 'opf',
),
 'application/ogg' =>
 array(
    0 => 'ogx',
),
 'application/omdoc+xml' =>
 array(
    0 => 'omdoc',
),
 'application/onenote' =>
 array(
    0 => 'onetoc',
    1 => 'onetoc2',
    2 => 'onetmp',
    3 => 'onepkg',
),
 'application/oxps' =>
 array(
    0 => 'oxps',
),
 'application/patch-ops-error+xml' =>
 array(
    0 => 'xer',
),
 'application/pdf' =>
 array(
    0 => 'pdf',
),
 'application/pgp-encrypted' =>
 array(
    0 => 'pgp',
),
 'application/pgp-signature' =>
 array(
    0 => 'asc',
    1 => 'sig',
),
 'application/pics-rules' =>
 array(
    0 => 'prf',
),
 'application/pkcs10' =>
 array(
    0 => 'p10',
),
 'application/pkcs7-mime' =>
 array(
    0 => 'p7m',
    1 => 'p7c',
),
 'application/pkcs7-signature' =>
 array(
    0 => 'p7s',
),
 'application/pkcs8' =>
 array(
    0 => 'p8',
),
 'application/pkix-attr-cert' =>
 array(
    0 => 'ac',
),
 'application/pkix-cert' =>
 array(
    0 => 'cer',
),
 'application/pkix-crl' =>
 array(
    0 => 'crl',
),
 'application/pkix-pkipath' =>
 array(
    0 => 'pkipath',
),
 'application/pkixcmp' =>
 array(
    0 => 'pki',
),
 'application/pls+xml' =>
 array(
    0 => 'pls',
),
 'application/postscript' =>
 array(
    0 => 'ai',
    1 => 'eps',
    2 => 'ps',
),
 'application/prs.cww' =>
 array(
    0 => 'cww',
),
 'application/pskc+xml' =>
 array(
    0 => 'pskcxml',
),
 'application/rdf+xml' =>
 array(
    0 => 'rdf',
),
 'application/reginfo+xml' =>
 array(
    0 => 'rif',
),
 'application/relax-ng-compact-syntax' =>
 array(
    0 => 'rnc',
),
 'application/resource-lists+xml' =>
 array(
    0 => 'rl',
),
 'application/resource-lists-diff+xml' =>
 array(
    0 => 'rld',
),
 'application/rls-services+xml' =>
 array(
    0 => 'rs',
),
 'application/rpki-ghostbusters' =>
 array(
    0 => 'gbr',
),
 'application/rpki-manifest' =>
 array(
    0 => 'mft',
),
 'application/rpki-roa' =>
 array(
    0 => 'roa',
),
 'application/rsd+xml' =>
 array(
    0 => 'rsd',
),
 'application/rss+xml' =>
 array(
    0 => 'rss',
),
 'application/rtf' =>
 array(
    0 => 'rtf',
),
 'application/sbml+xml' =>
 array(
    0 => 'sbml',
),
 'application/scvp-cv-request' =>
 array(
    0 => 'scq',
),
 'application/scvp-cv-response' =>
 array(
    0 => 'scs',
),
 'application/scvp-vp-request' =>
 array(
    0 => 'spq',
),
 'application/scvp-vp-response' =>
 array(
    0 => 'spp',
),
 'application/sdp' =>
 array(
    0 => 'sdp',
),
 'application/set-payment-initiation' =>
 array(
    0 => 'setpay',
),
 'application/set-registration-initiation' =>
 array(
    0 => 'setreg',
),
 'application/shf+xml' =>
 array(
    0 => 'shf',
),
 'application/smil+xml' =>
 array(
    0 => 'smi',
    1 => 'smil',
),
 'application/sparql-query' =>
 array(
    0 => 'rq',
),
 'application/sparql-results+xml' =>
 array(
    0 => 'srx',
),
 'application/srgs' =>
 array(
    0 => 'gram',
),
 'application/srgs+xml' =>
 array(
    0 => 'grxml',
),
 'application/sru+xml' =>
 array(
    0 => 'sru',
),
 'application/ssdl+xml' =>
 array(
    0 => 'ssdl',
),
 'application/ssml+xml' =>
 array(
    0 => 'ssml',
),
 'application/tei+xml' =>
 array(
    0 => 'tei',
    1 => 'teicorpus',
),
 'application/thraud+xml' =>
 array(
    0 => 'tfi',
),
 'application/timestamped-data' =>
 array(
    0 => 'tsd',
),
 'application/vnd.3gpp.pic-bw-large' =>
 array(
    0 => 'plb',
),
 'application/vnd.3gpp.pic-bw-small' =>
 array(
    0 => 'psb',
),
 'application/vnd.3gpp.pic-bw-var' =>
 array(
    0 => 'pvb',
),
 'application/vnd.3gpp2.tcap' =>
 array(
    0 => 'tcap',
),
 'application/vnd.3m.post-it-notes' =>
 array(
    0 => 'pwn',
),
 'application/vnd.accpac.simply.aso' =>
 array(
    0 => 'aso',
),
 'application/vnd.accpac.simply.imp' =>
 array(
    0 => 'imp',
),
 'application/vnd.acucobol' =>
 array(
    0 => 'acu',
),
 'application/vnd.acucorp' =>
 array(
    0 => 'atc',
    1 => 'acutc',
),
 'application/vnd.adobe.air-application-installer-package+zip' =>
 array(
    0 => 'air',
),
 'application/vnd.adobe.formscentral.fcdt' =>
 array(
    0 => 'fcdt',
),
 'application/vnd.adobe.fxp' =>
 array(
    0 => 'fxp',
    1 => 'fxpl',
),
 'application/vnd.adobe.xdp+xml' =>
 array(
    0 => 'xdp',
),
 'application/vnd.adobe.xfdf' =>
 array(
    0 => 'xfdf',
),
 'application/vnd.ahead.space' =>
 array(
    0 => 'ahead',
),
 'application/vnd.airzip.filesecure.azf' =>
 array(
    0 => 'azf',
),
 'application/vnd.airzip.filesecure.azs' =>
 array(
    0 => 'azs',
),
 'application/vnd.amazon.ebook' =>
 array(
    0 => 'azw',
),
 'application/vnd.americandynamics.acc' =>
 array(
    0 => 'acc',
),
 'application/vnd.amiga.ami' =>
 array(
    0 => 'ami',
),
 'application/vnd.android.package-archive' =>
 array(
    0 => 'apk',
),
 'application/vnd.anser-web-certificate-issue-initiation' =>
 array(
    0 => 'cii',
),
 'application/vnd.anser-web-funds-transfer-initiation' =>
 array(
    0 => 'fti',
),
 'application/vnd.antix.game-component' =>
 array(
    0 => 'atx',
),
 'application/vnd.apple.installer+xml' =>
 array(
    0 => 'mpkg',
),
 'application/vnd.apple.mpegurl' =>
 array(
    0 => 'm3u8',
),
 'application/vnd.aristanetworks.swi' =>
 array(
    0 => 'swi',
),
 'application/vnd.astraea-software.iota' =>
 array(
    0 => 'iota',
),
 'application/vnd.audiograph' =>
 array(
    0 => 'aep',
),
 'application/vnd.blueice.multipass' =>
 array(
    0 => 'mpm',
),
 'application/vnd.bmi' =>
 array(
    0 => 'bmi',
),
 'application/vnd.businessobjects' =>
 array(
    0 => 'rep',
),
 'application/vnd.chemdraw+xml' =>
 array(
    0 => 'cdxml',
),
 'application/vnd.chipnuts.karaoke-mmd' =>
 array(
    0 => 'mmd',
),
 'application/vnd.cinderella' =>
 array(
    0 => 'cdy',
),
 'application/vnd.claymore' =>
 array(
    0 => 'cla',
),
 'application/vnd.cloanto.rp9' =>
 array(
    0 => 'rp9',
),
 'application/vnd.clonk.c4group' =>
 array(
    0 => 'c4g',
    1 => 'c4d',
    2 => 'c4f',
    3 => 'c4p',
    4 => 'c4u',
),
 'application/vnd.cluetrust.cartomobile-config' =>
 array(
    0 => 'c11amc',
),
 'application/vnd.cluetrust.cartomobile-config-pkg' =>
 array(
    0 => 'c11amz',
),
 'application/vnd.commonspace' =>
 array(
    0 => 'csp',
),
 'application/vnd.contact.cmsg' =>
 array(
    0 => 'cdbcmsg',
),
 'application/vnd.cosmocaller' =>
 array(
    0 => 'cmc',
),
 'application/vnd.crick.clicker' =>
 array(
    0 => 'clkx',
),
 'application/vnd.crick.clicker.keyboard' =>
 array(
    0 => 'clkk',
),
 'application/vnd.crick.clicker.palette' =>
 array(
    0 => 'clkp',
),
 'application/vnd.crick.clicker.template' =>
 array(
    0 => 'clkt',
),
 'application/vnd.crick.clicker.wordbank' =>
 array(
    0 => 'clkw',
),
 'application/vnd.criticaltools.wbs+xml' =>
 array(
    0 => 'wbs',
),
 'application/vnd.ctc-posml' =>
 array(
    0 => 'pml',
),
 'application/vnd.cups-ppd' =>
 array(
    0 => 'ppd',
),
 'application/vnd.curl.car' =>
 array(
    0 => 'car',
),
 'application/vnd.curl.pcurl' =>
 array(
    0 => 'pcurl',
),
 'application/vnd.dart' =>
 array(
    0 => 'dart',
),
 'application/vnd.data-vision.rdz' =>
 array(
    0 => 'rdz',
),
 'application/vnd.dece.data' =>
 array(
    0 => 'uvf',
    1 => 'uvvf',
    2 => 'uvd',
    3 => 'uvvd',
),
 'application/vnd.dece.ttml+xml' =>
 array(
    0 => 'uvt',
    1 => 'uvvt',
),
 'application/vnd.dece.unspecified' =>
 array(
    0 => 'uvx',
    1 => 'uvvx',
),
 'application/vnd.dece.zip' =>
 array(
    0 => 'uvz',
    1 => 'uvvz',
),
 'application/vnd.denovo.fcselayout-link' =>
 array(
    0 => 'fe_launch',
),
 'application/vnd.dna' =>
 array(
    0 => 'dna',
),
 'application/vnd.dolby.mlp' =>
 array(
    0 => 'mlp',
),
 'application/vnd.dpgraph' =>
 array(
    0 => 'dpg',
),
 'application/vnd.dreamfactory' =>
 array(
    0 => 'dfac',
),
 'application/vnd.ds-keypoint' =>
 array(
    0 => 'kpxx',
),
 'application/vnd.dvb.ait' =>
 array(
    0 => 'ait',
),
 'application/vnd.dvb.service' =>
 array(
    0 => 'svc',
),
 'application/vnd.dynageo' =>
 array(
    0 => 'geo',
),
 'application/vnd.ecowin.chart' =>
 array(
    0 => 'mag',
),
 'application/vnd.enliven' =>
 array(
    0 => 'nml',
),
 'application/vnd.epson.esf' =>
 array(
    0 => 'esf',
),
 'application/vnd.epson.msf' =>
 array(
    0 => 'msf',
),
 'application/vnd.epson.quickanime' =>
 array(
    0 => 'qam',
),
 'application/vnd.epson.salt' =>
 array(
    0 => 'slt',
),
 'application/vnd.epson.ssf' =>
 array(
    0 => 'ssf',
),
 'application/vnd.eszigno3+xml' =>
 array(
    0 => 'es3',
    1 => 'et3',
),
 'application/vnd.ezpix-album' =>
 array(
    0 => 'ez2',
),
 'application/vnd.ezpix-package' =>
 array(
    0 => 'ez3',
),
 'application/vnd.fdf' =>
 array(
    0 => 'fdf',
),
 'application/vnd.fdsn.mseed' =>
 array(
    0 => 'mseed',
),
 'application/vnd.fdsn.seed' =>
 array(
    0 => 'seed',
    1 => 'dataless',
),
 'application/vnd.flographit' =>
 array(
    0 => 'gph',
),
 'application/vnd.fluxtime.clip' =>
 array(
    0 => 'ftc',
),
 'application/vnd.framemaker' =>
 array(
    0 => 'fm',
    1 => 'frame',
    2 => 'maker',
    3 => 'book',
),
 'application/vnd.frogans.fnc' =>
 array(
    0 => 'fnc',
),
 'application/vnd.frogans.ltf' =>
 array(
    0 => 'ltf',
),
 'application/vnd.fsc.weblaunch' =>
 array(
    0 => 'fsc',
),
 'application/vnd.fujitsu.oasys' =>
 array(
    0 => 'oas',
),
 'application/vnd.fujitsu.oasys2' =>
 array(
    0 => 'oa2',
),
 'application/vnd.fujitsu.oasys3' =>
 array(
    0 => 'oa3',
),
 'application/vnd.fujitsu.oasysgp' =>
 array(
    0 => 'fg5',
),
 'application/vnd.fujitsu.oasysprs' =>
 array(
    0 => 'bh2',
),
 'application/vnd.fujixerox.ddd' =>
 array(
    0 => 'ddd',
),
 'application/vnd.fujixerox.docuworks' =>
 array(
    0 => 'xdw',
),
 'application/vnd.fujixerox.docuworks.binder' =>
 array(
    0 => 'xbd',
),
 'application/vnd.fuzzysheet' =>
 array(
    0 => 'fzs',
),
 'application/vnd.genomatix.tuxedo' =>
 array(
    0 => 'txd',
),
 'application/vnd.geogebra.file' =>
 array(
    0 => 'ggb',
),
 'application/vnd.geogebra.tool' =>
 array(
    0 => 'ggt',
),
 'application/vnd.geometry-explorer' =>
 array(
    0 => 'gex',
    1 => 'gre',
),
 'application/vnd.geonext' =>
 array(
    0 => 'gxt',
),
 'application/vnd.geoplan' =>
 array(
    0 => 'g2w',
),
 'application/vnd.geospace' =>
 array(
    0 => 'g3w',
),
 'application/vnd.gmx' =>
 array(
    0 => 'gmx',
),
 'application/vnd.google-earth.kml+xml' =>
 array(
    0 => 'kml',
),
 'application/vnd.google-earth.kmz' =>
 array(
    0 => 'kmz',
),
 'application/vnd.grafeq' =>
 array(
    0 => 'gqf',
    1 => 'gqs',
),
 'application/vnd.groove-account' =>
 array(
    0 => 'gac',
),
 'application/vnd.groove-help' =>
 array(
    0 => 'ghf',
),
 'application/vnd.groove-identity-message' =>
 array(
    0 => 'gim',
),
 'application/vnd.groove-injector' =>
 array(
    0 => 'grv',
),
 'application/vnd.groove-tool-message' =>
 array(
    0 => 'gtm',
),
 'application/vnd.groove-tool-template' =>
 array(
    0 => 'tpl',
),
 'application/vnd.groove-vcard' =>
 array(
    0 => 'vcg',
),
 'application/vnd.hal+xml' =>
 array(
    0 => 'hal',
),
 'application/vnd.handheld-entertainment+xml' =>
 array(
    0 => 'zmm',
),
 'application/vnd.hbci' =>
 array(
    0 => 'hbci',
),
 'application/vnd.hhe.lesson-player' =>
 array(
    0 => 'les',
),
 'application/vnd.hp-hpgl' =>
 array(
    0 => 'hpgl',
),
 'application/vnd.hp-hpid' =>
 array(
    0 => 'hpid',
),
 'application/vnd.hp-hps' =>
 array(
    0 => 'hps',
),
 'application/vnd.hp-jlyt' =>
 array(
    0 => 'jlt',
),
 'application/vnd.hp-pcl' =>
 array(
    0 => 'pcl',
),
 'application/vnd.hp-pclxl' =>
 array(
    0 => 'pclxl',
),
 'application/vnd.hydrostatix.sof-data' =>
 array(
    0 => 'sfd-hdstx',
),
 'application/vnd.ibm.minipay' =>
 array(
    0 => 'mpy',
),
 'application/vnd.ibm.modcap' =>
 array(
    0 => 'afp',
    1 => 'listafp',
    2 => 'list3820',
),
 'application/vnd.ibm.rights-management' =>
 array(
    0 => 'irm',
),
 'application/vnd.ibm.secure-container' =>
 array(
    0 => 'sc',
),
 'application/vnd.iccprofile' =>
 array(
    0 => 'icc',
    1 => 'icm',
),
 'application/vnd.igloader' =>
 array(
    0 => 'igl',
),
 'application/vnd.immervision-ivp' =>
 array(
    0 => 'ivp',
),
 'application/vnd.immervision-ivu' =>
 array(
    0 => 'ivu',
),
 'application/vnd.insors.igm' =>
 array(
    0 => 'igm',
),
 'application/vnd.intercon.formnet' =>
 array(
    0 => 'xpw',
    1 => 'xpx',
),
 'application/vnd.intergeo' =>
 array(
    0 => 'i2g',
),
 'application/vnd.intu.qbo' =>
 array(
    0 => 'qbo',
),
 'application/vnd.intu.qfx' =>
 array(
    0 => 'qfx',
),
 'application/vnd.ipunplugged.rcprofile' =>
 array(
    0 => 'rcprofile',
),
 'application/vnd.irepository.package+xml' =>
 array(
    0 => 'irp',
),
 'application/vnd.is-xpr' =>
 array(
    0 => 'xpr',
),
 'application/vnd.isac.fcs' =>
 array(
    0 => 'fcs',
),
 'application/vnd.jam' =>
 array(
    0 => 'jam',
),
 'application/vnd.jcp.javame.midlet-rms' =>
 array(
    0 => 'rms',
),
 'application/vnd.jisp' =>
 array(
    0 => 'jisp',
),
 'application/vnd.joost.joda-archive' =>
 array(
    0 => 'joda',
),
 'application/vnd.kahootz' =>
 array(
    0 => 'ktz',
    1 => 'ktr',
),
 'application/vnd.kde.karbon' =>
 array(
    0 => 'karbon',
),
 'application/vnd.kde.kchart' =>
 array(
    0 => 'chrt',
),
 'application/vnd.kde.kformula' =>
 array(
    0 => 'kfo',
),
 'application/vnd.kde.kivio' =>
 array(
    0 => 'flw',
),
 'application/vnd.kde.kontour' =>
 array(
    0 => 'kon',
),
 'application/vnd.kde.kpresenter' =>
 array(
    0 => 'kpr',
    1 => 'kpt',
),
 'application/vnd.kde.kspread' =>
 array(
    0 => 'ksp',
),
 'application/vnd.kde.kword' =>
 array(
    0 => 'kwd',
    1 => 'kwt',
),
 'application/vnd.kenameaapp' =>
 array(
    0 => 'htke',
),
 'application/vnd.kidspiration' =>
 array(
    0 => 'kia',
),
 'application/vnd.kinar' =>
 array(
    0 => 'kne',
    1 => 'knp',
),
 'application/vnd.koan' =>
 array(
    0 => 'skp',
    1 => 'skd',
    2 => 'skt',
    3 => 'skm',
),
 'application/vnd.kodak-descriptor' =>
 array(
    0 => 'sse',
),
 'application/vnd.las.las+xml' =>
 array(
    0 => 'lasxml',
),
 'application/vnd.llamagraphics.life-balance.desktop' =>
 array(
    0 => 'lbd',
),
 'application/vnd.llamagraphics.life-balance.exchange+xml' =>
 array(
    0 => 'lbe',
),
 'application/vnd.lotus-1-2-3' =>
 array(
    0 => '123',
),
 'application/vnd.lotus-approach' =>
 array(
    0 => 'apr',
),
 'application/vnd.lotus-freelance' =>
 array(
    0 => 'pre',
),
 'application/vnd.lotus-notes' =>
 array(
    0 => 'nsf',
),
 'application/vnd.lotus-organizer' =>
 array(
    0 => 'org',
),
 'application/vnd.lotus-screencam' =>
 array(
    0 => 'scm',
),
 'application/vnd.lotus-wordpro' =>
 array(
    0 => 'lwp',
),
 'application/vnd.macports.portpkg' =>
 array(
    0 => 'portpkg',
),
 'application/vnd.mcd' =>
 array(
    0 => 'mcd',
),
 'application/vnd.medcalcdata' =>
 array(
    0 => 'mc1',
),
 'application/vnd.mediastation.cdkey' =>
 array(
    0 => 'cdkey',
),
 'application/vnd.mfer' =>
 array(
    0 => 'mwf',
),
 'application/vnd.mfmp' =>
 array(
    0 => 'mfm',
),
 'application/vnd.micrografx.flo' =>
 array(
    0 => 'flo',
),
 'application/vnd.micrografx.igx' =>
 array(
    0 => 'igx',
),
 'application/vnd.mif' =>
 array(
    0 => 'mif',
),
 'application/vnd.mobius.daf' =>
 array(
    0 => 'daf',
),
 'application/vnd.mobius.dis' =>
 array(
    0 => 'dis',
),
 'application/vnd.mobius.mbk' =>
 array(
    0 => 'mbk',
),
 'application/vnd.mobius.mqy' =>
 array(
    0 => 'mqy',
),
 'application/vnd.mobius.msl' =>
 array(
    0 => 'msl',
),
 'application/vnd.mobius.plc' =>
 array(
    0 => 'plc',
),
 'application/vnd.mobius.txf' =>
 array(
    0 => 'txf',
),
 'application/vnd.mophun.application' =>
 array(
    0 => 'mpn',
),
 'application/vnd.mophun.certificate' =>
 array(
    0 => 'mpc',
),
 'application/vnd.mozilla.xul+xml' =>
 array(
    0 => 'xul',
),
 'application/vnd.ms-artgalry' =>
 array(
    0 => 'cil',
),
 'application/vnd.ms-cab-compressed' =>
 array(
    0 => 'cab',
),
 'application/vnd.ms-excel' =>
 array(
    0 => 'xls',
    1 => 'xlm',
    2 => 'xla',
    3 => 'xlc',
    4 => 'xlt',
    5 => 'xlw',
),
 'application/vnd.ms-excel.addin.macroenabled.12' =>
 array(
    0 => 'xlam',
),
 'application/vnd.ms-excel.sheet.binary.macroenabled.12' =>
 array(
    0 => 'xlsb',
),
 'application/vnd.ms-excel.sheet.macroenabled.12' =>
 array(
    0 => 'xlsm',
),
 'application/vnd.ms-excel.template.macroenabled.12' =>
 array(
    0 => 'xltm',
),
 'application/vnd.ms-fontobject' =>
 array(
    0 => 'eot',
),
 'application/vnd.ms-htmlhelp' =>
 array(
    0 => 'chm',
),
 'application/vnd.ms-ims' =>
 array(
    0 => 'ims',
),
 'application/vnd.ms-lrm' =>
 array(
    0 => 'lrm',
),
 'application/vnd.ms-officetheme' =>
 array(
    0 => 'thmx',
),
 'application/vnd.ms-pki.seccat' =>
 array(
    0 => 'cat',
),
 'application/vnd.ms-pki.stl' =>
 array(
    0 => 'stl',
),
 'application/vnd.ms-powerpoint' =>
 array(
    0 => 'ppt',
    1 => 'pps',
    2 => 'pot',
),
 'application/vnd.ms-powerpoint.addin.macroenabled.12' =>
 array(
    0 => 'ppam',
),
 'application/vnd.ms-powerpoint.presentation.macroenabled.12' =>
 array(
    0 => 'pptm',
),
 'application/vnd.ms-powerpoint.slide.macroenabled.12' =>
 array(
    0 => 'sldm',
),
 'application/vnd.ms-powerpoint.slideshow.macroenabled.12' =>
 array(
    0 => 'ppsm',
),
 'application/vnd.ms-powerpoint.template.macroenabled.12' =>
 array(
    0 => 'potm',
),
 'application/vnd.ms-project' =>
 array(
    0 => 'mpp',
    1 => 'mpt',
),
 'application/vnd.ms-word.document.macroenabled.12' =>
 array(
    0 => 'docm',
),
 'application/vnd.ms-word.template.macroenabled.12' =>
 array(
    0 => 'dotm',
),
 'application/vnd.ms-works' =>
 array(
    0 => 'wps',
    1 => 'wks',
    2 => 'wcm',
    3 => 'wdb',
),
 'application/vnd.ms-wpl' =>
 array(
    0 => 'wpl',
),
 'application/vnd.ms-xpsdocument' =>
 array(
    0 => 'xps',
),
 'application/vnd.mseq' =>
 array(
    0 => 'mseq',
),
 'application/vnd.musician' =>
 array(
    0 => 'mus',
),
 'application/vnd.muvee.style' =>
 array(
    0 => 'msty',
),
 'application/vnd.mynfc' =>
 array(
    0 => 'taglet',
),
 'application/vnd.neurolanguage.nlu' =>
 array(
    0 => 'nlu',
),
 'application/vnd.nitf' =>
 array(
    0 => 'ntf',
    1 => 'nitf',
),
 'application/vnd.noblenet-directory' =>
 array(
    0 => 'nnd',
),
 'application/vnd.noblenet-sealer' =>
 array(
    0 => 'nns',
),
 'application/vnd.noblenet-web' =>
 array(
    0 => 'nnw',
),
 'application/vnd.nokia.n-gage.data' =>
 array(
    0 => 'ngdat',
),
 'application/vnd.nokia.n-gage.symbian.install' =>
 array(
    0 => 'n-gage',
),
 'application/vnd.nokia.radio-preset' =>
 array(
    0 => 'rpst',
),
 'application/vnd.nokia.radio-presets' =>
 array(
    0 => 'rpss',
),
 'application/vnd.novadigm.edm' =>
 array(
    0 => 'edm',
),
 'application/vnd.novadigm.edx' =>
 array(
    0 => 'edx',
),
 'application/vnd.novadigm.ext' =>
 array(
    0 => 'ext',
),
 'application/vnd.oasis.opendocument.chart' =>
 array(
    0 => 'odc',
),
 'application/vnd.oasis.opendocument.chart-template' =>
 array(
    0 => 'otc',
),
 'application/vnd.oasis.opendocument.database' =>
 array(
    0 => 'odb',
),
 'application/vnd.oasis.opendocument.formula' =>
 array(
    0 => 'odf',
),
 'application/vnd.oasis.opendocument.formula-template' =>
 array(
    0 => 'odft',
),
 'application/vnd.oasis.opendocument.graphics' =>
 array(
    0 => 'odg',
),
 'application/vnd.oasis.opendocument.graphics-template' =>
 array(
    0 => 'otg',
),
 'application/vnd.oasis.opendocument.image' =>
 array(
    0 => 'odi',
),
 'application/vnd.oasis.opendocument.image-template' =>
 array(
    0 => 'oti',
),
 'application/vnd.oasis.opendocument.presentation' =>
 array(
    0 => 'odp',
),
 'application/vnd.oasis.opendocument.presentation-template' =>
 array(
    0 => 'otp',
),
 'application/vnd.oasis.opendocument.spreadsheet' =>
 array(
    0 => 'ods',
),
 'application/vnd.oasis.opendocument.spreadsheet-template' =>
 array(
    0 => 'ots',
),
 'application/vnd.oasis.opendocument.text' =>
 array(
    0 => 'odt',
),
 'application/vnd.oasis.opendocument.text-master' =>
 array(
    0 => 'odm',
),
 'application/vnd.oasis.opendocument.text-template' =>
 array(
    0 => 'ott',
),
 'application/vnd.oasis.opendocument.text-web' =>
 array(
    0 => 'oth',
),
 'application/vnd.olpc-sugar' =>
 array(
    0 => 'xo',
),
 'application/vnd.oma.dd2+xml' =>
 array(
    0 => 'dd2',
),
 'application/vnd.openofficeorg.extension' =>
 array(
    0 => 'oxt',
),
 'application/vnd.openxmlformats-officedocument.presentationml.presentation' =>
 array(
    0 => 'pptx',
),
 'application/vnd.openxmlformats-officedocument.presentationml.slide' =>
 array(
    0 => 'sldx',
),
 'application/vnd.openxmlformats-officedocument.presentationml.slideshow' =>
 array(
    0 => 'ppsx',
),
 'application/vnd.openxmlformats-officedocument.presentationml.template' =>
 array(
    0 => 'potx',
),
 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' =>
 array(
    0 => 'xlsx',
),
 'application/vnd.openxmlformats-officedocument.spreadsheetml.template' =>
 array(
    0 => 'xltx',
),
 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' =>
 array(
    0 => 'docx',
),
 'application/vnd.openxmlformats-officedocument.wordprocessingml.template' =>
 array(
    0 => 'dotx',
),
 'application/vnd.osgeo.mapguide.package' =>
 array(
    0 => 'mgp',
),
 'application/vnd.osgi.dp' =>
 array(
    0 => 'dp',
),
 'application/vnd.osgi.subsystem' =>
 array(
    0 => 'esa',
),
 'application/vnd.palm' =>
 array(
    0 => 'pdb',
    1 => 'pqa',
    2 => 'oprc',
),
 'application/vnd.pawaafile' =>
 array(
    0 => 'paw',
),
 'application/vnd.pg.format' =>
 array(
    0 => 'str',
),
 'application/vnd.pg.osasli' =>
 array(
    0 => 'ei6',
),
 'application/vnd.picsel' =>
 array(
    0 => 'efif',
),
 'application/vnd.pmi.widget' =>
 array(
    0 => 'wg',
),
 'application/vnd.pocketlearn' =>
 array(
    0 => 'plf',
),
 'application/vnd.powerbuilder6' =>
 array(
    0 => 'pbd',
),
 'application/vnd.previewsystems.box' =>
 array(
    0 => 'box',
),
 'application/vnd.proteus.magazine' =>
 array(
    0 => 'mgz',
),
 'application/vnd.publishare-delta-tree' =>
 array(
    0 => 'qps',
),
 'application/vnd.pvi.ptid1' =>
 array(
    0 => 'ptid',
),
 'application/vnd.quark.quarkxpress' =>
 array(
    0 => 'qxd',
    1 => 'qxt',
    2 => 'qwd',
    3 => 'qwt',
    4 => 'qxl',
    5 => 'qxb',
),
 'application/vnd.realvnc.bed' =>
 array(
    0 => 'bed',
),
 'application/vnd.recordare.musicxml' =>
 array(
    0 => 'mxl',
),
 'application/vnd.recordare.musicxml+xml' =>
 array(
    0 => 'musicxml',
),
 'application/vnd.rig.cryptonote' =>
 array(
    0 => 'cryptonote',
),
 'application/vnd.rim.cod' =>
 array(
    0 => 'cod',
),
 'application/vnd.rn-realmedia' =>
 array(
    0 => 'rm',
),
 'application/vnd.rn-realmedia-vbr' =>
 array(
    0 => 'rmvb',
),
 'application/vnd.route66.link66+xml' =>
 array(
    0 => 'link66',
),
 'application/vnd.sailingtracker.track' =>
 array(
    0 => 'st',
),
 'application/vnd.seemail' =>
 array(
    0 => 'see',
),
 'application/vnd.sema' =>
 array(
    0 => 'sema',
),
 'application/vnd.semd' =>
 array(
    0 => 'semd',
),
 'application/vnd.semf' =>
 array(
    0 => 'semf',
),
 'application/vnd.shana.informed.formdata' =>
 array(
    0 => 'ifm',
),
 'application/vnd.shana.informed.formtemplate' =>
 array(
    0 => 'itp',
),
 'application/vnd.shana.informed.interchange' =>
 array(
    0 => 'iif',
),
 'application/vnd.shana.informed.package' =>
 array(
    0 => 'ipk',
),
 'application/vnd.simtech-mindmapper' =>
 array(
    0 => 'twd',
    1 => 'twds',
),
 'application/vnd.smaf' =>
 array(
    0 => 'mmf',
),
 'application/vnd.smart.teacher' =>
 array(
    0 => 'teacher',
),
 'application/vnd.solent.sdkm+xml' =>
 array(
    0 => 'sdkm',
    1 => 'sdkd',
),
 'application/vnd.spotfire.dxp' =>
 array(
    0 => 'dxp',
),
 'application/vnd.spotfire.sfs' =>
 array(
    0 => 'sfs',
),
 'application/vnd.stardivision.calc' =>
 array(
    0 => 'sdc',
),
 'application/vnd.stardivision.draw' =>
 array(
    0 => 'sda',
),
 'application/vnd.stardivision.impress' =>
 array(
    0 => 'sdd',
),
 'application/vnd.stardivision.math' =>
 array(
    0 => 'smf',
),
 'application/vnd.stardivision.writer' =>
 array(
    0 => 'sdw',
    1 => 'vor',
),
 'application/vnd.stardivision.writer-global' =>
 array(
    0 => 'sgl',
),
 'application/vnd.stepmania.package' =>
 array(
    0 => 'smzip',
),
 'application/vnd.stepmania.stepchart' =>
 array(
    0 => 'sm',
),
 'application/vnd.sun.xml.calc' =>
 array(
    0 => 'sxc',
),
 'application/vnd.sun.xml.calc.template' =>
 array(
    0 => 'stc',
),
 'application/vnd.sun.xml.draw' =>
 array(
    0 => 'sxd',
),
 'application/vnd.sun.xml.draw.template' =>
 array(
    0 => 'std',
),
 'application/vnd.sun.xml.impress' =>
 array(
    0 => 'sxi',
),
 'application/vnd.sun.xml.impress.template' =>
 array(
    0 => 'sti',
),
 'application/vnd.sun.xml.math' =>
 array(
    0 => 'sxm',
),
 'application/vnd.sun.xml.writer' =>
 array(
    0 => 'sxw',
),
 'application/vnd.sun.xml.writer.global' =>
 array(
    0 => 'sxg',
),
 'application/vnd.sun.xml.writer.template' =>
 array(
    0 => 'stw',
),
 'application/vnd.sus-calendar' =>
 array(
    0 => 'sus',
    1 => 'susp',
),
 'application/vnd.svd' =>
 array(
    0 => 'svd',
),
 'application/vnd.symbian.install' =>
 array(
    0 => 'sis',
    1 => 'sisx',
),
 'application/vnd.syncml+xml' =>
 array(
    0 => 'xsm',
),
 'application/vnd.syncml.dm+wbxml' =>
 array(
    0 => 'bdm',
),
 'application/vnd.syncml.dm+xml' =>
 array(
    0 => 'xdm',
),
 'application/vnd.tao.intent-module-archive' =>
 array(
    0 => 'tao',
),
 'application/vnd.tcpdump.pcap' =>
 array(
    0 => 'pcap',
    1 => 'cap',
    2 => 'dmp',
),
 'application/vnd.tmobile-livetv' =>
 array(
    0 => 'tmo',
),
 'application/vnd.trid.tpt' =>
 array(
    0 => 'tpt',
),
 'application/vnd.triscape.mxs' =>
 array(
    0 => 'mxs',
),
 'application/vnd.trueapp' =>
 array(
    0 => 'tra',
),
 'application/vnd.ufdl' =>
 array(
    0 => 'ufd',
    1 => 'ufdl',
),
 'application/vnd.uiq.theme' =>
 array(
    0 => 'utz',
),
 'application/vnd.umajin' =>
 array(
    0 => 'umj',
),
 'application/vnd.unity' =>
 array(
    0 => 'unityweb',
),
 'application/vnd.uoml+xml' =>
 array(
    0 => 'uoml',
),
 'application/vnd.vcx' =>
 array(
    0 => 'vcx',
),
 'application/vnd.visio' =>
 array(
    0 => 'vsd',
    1 => 'vst',
    2 => 'vss',
    3 => 'vsw',
),
 'application/vnd.visionary' =>
 array(
    0 => 'vis',
),
 'application/vnd.vsf' =>
 array(
    0 => 'vsf',
),
 'application/vnd.wap.wbxml' =>
 array(
    0 => 'wbxml',
),
 'application/vnd.wap.wmlc' =>
 array(
    0 => 'wmlc',
),
 'application/vnd.wap.wmlscriptc' =>
 array(
    0 => 'wmlsc',
),
 'application/vnd.webturbo' =>
 array(
    0 => 'wtb',
),
 'application/vnd.wolfram.player' =>
 array(
    0 => 'nbp',
),
 'application/vnd.wordperfect' =>
 array(
    0 => 'wpd',
),
 'application/vnd.wqd' =>
 array(
    0 => 'wqd',
),
 'application/vnd.wt.stf' =>
 array(
    0 => 'stf',
),
 'application/vnd.xara' =>
 array(
    0 => 'xar',
),
 'application/vnd.xfdl' =>
 array(
    0 => 'xfdl',
),
 'application/vnd.yamaha.hv-dic' =>
 array(
    0 => 'hvd',
),
 'application/vnd.yamaha.hv-script' =>
 array(
    0 => 'hvs',
),
 'application/vnd.yamaha.hv-voice' =>
 array(
    0 => 'hvp',
),
 'application/vnd.yamaha.openscoreformat' =>
 array(
    0 => 'osf',
),
 'application/vnd.yamaha.openscoreformat.osfpvg+xml' =>
 array(
    0 => 'osfpvg',
),
 'application/vnd.yamaha.smaf-audio' =>
 array(
    0 => 'saf',
),
 'application/vnd.yamaha.smaf-phrase' =>
 array(
    0 => 'spf',
),
 'application/vnd.yellowriver-custom-menu' =>
 array(
    0 => 'cmp',
),
 'application/vnd.zul' =>
 array(
    0 => 'zir',
    1 => 'zirz',
),
 'application/vnd.zzazz.deck+xml' =>
 array(
    0 => 'zaz',
),
 'application/voicexml+xml' =>
 array(
    0 => 'vxml',
),
 'application/widget' =>
 array(
    0 => 'wgt',
),
 'application/winhlp' =>
 array(
    0 => 'hlp',
),
 'application/wsdl+xml' =>
 array(
    0 => 'wsdl',
),
 'application/wspolicy+xml' =>
 array(
    0 => 'wspolicy',
),
 'application/x-7z-compressed' =>
 array(
    0 => '7z',
),
 'application/x-abiword' =>
 array(
    0 => 'abw',
),
 'application/x-ace-compressed' =>
 array(
    0 => 'ace',
),
 'application/x-apple-diskimage' =>
 array(
    0 => 'dmg',
),
 'application/x-authorware-bin' =>
 array(
    0 => 'aab',
    1 => 'x32',
    2 => 'u32',
    3 => 'vox',
),
 'application/x-authorware-map' =>
 array(
    0 => 'aam',
),
 'application/x-authorware-seg' =>
 array(
    0 => 'aas',
),
 'application/x-bcpio' =>
 array(
    0 => 'bcpio',
),
 'application/x-bittorrent' =>
 array(
    0 => 'torrent',
),
 'application/x-blorb' =>
 array(
    0 => 'blb',
    1 => 'blorb',
),
 'application/x-bzip' =>
 array(
    0 => 'bz',
),
 'application/x-bzip2' =>
 array(
    0 => 'bz2',
    1 => 'boz',
),
 'application/x-cbr' =>
 array(
    0 => 'cbr',
    1 => 'cba',
    2 => 'cbt',
    3 => 'cbz',
    4 => 'cb7',
),
 'application/x-cdlink' =>
 array(
    0 => 'vcd',
),
 'application/x-cfs-compressed' =>
 array(
    0 => 'cfs',
),
 'application/x-chat' =>
 array(
    0 => 'chat',
),
 'application/x-chess-pgn' =>
 array(
    0 => 'pgn',
),
 'application/x-conference' =>
 array(
    0 => 'nsc',
),
 'application/x-cpio' =>
 array(
    0 => 'cpio',
),
 'application/x-csh' =>
 array(
    0 => 'csh',
),
 'application/x-debian-package' =>
 array(
    0 => 'deb',
    1 => 'udeb',
),
 'application/x-dgc-compressed' =>
 array(
    0 => 'dgc',
),
 'application/x-director' =>
 array(
    0 => 'dir',
    1 => 'dcr',
    2 => 'dxr',
    3 => 'cst',
    4 => 'cct',
    5 => 'cxt',
    6 => 'w3d',
    7 => 'fgd',
    8 => 'swa',
),
 'application/x-doom' =>
 array(
    0 => 'wad',
),
 'application/x-dtbncx+xml' =>
 array(
    0 => 'ncx',
),
 'application/x-dtbook+xml' =>
 array(
    0 => 'dtb',
),
 'application/x-dtbresource+xml' =>
 array(
    0 => 'res',
),
 'application/x-dvi' =>
 array(
    0 => 'dvi',
),
 'application/x-envoy' =>
 array(
    0 => 'evy',
),
 'application/x-eva' =>
 array(
    0 => 'eva',
),
 'application/x-font-bdf' =>
 array(
    0 => 'bdf',
),
 'application/x-font-ghostscript' =>
 array(
    0 => 'gsf',
),
 'application/x-font-linux-psf' =>
 array(
    0 => 'psf',
),
 'application/x-font-otf' =>
 array(
    0 => 'otf',
),
 'application/x-font-pcf' =>
 array(
    0 => 'pcf',
),
 'application/x-font-snf' =>
 array(
    0 => 'snf',
),
 'application/x-font-ttf' =>
 array(
    0 => 'ttf',
    1 => 'ttc',
),
 'application/x-font-type1' =>
 array(
    0 => 'pfa',
    1 => 'pfb',
    2 => 'pfm',
    3 => 'afm',
),
 'application/x-font-woff' =>
 array(
    0 => 'woff',
),
 'application/x-freearc' =>
 array(
    0 => 'arc',
),
 'application/x-futuresplash' =>
 array(
    0 => 'spl',
),
 'application/x-gca-compressed' =>
 array(
    0 => 'gca',
),
 'application/x-glulx' =>
 array(
    0 => 'ulx',
),
 'application/x-gnumeric' =>
 array(
    0 => 'gnumeric',
),
 'application/x-gramps-xml' =>
 array(
    0 => 'gramps',
),
 'application/x-gtar' =>
 array(
    0 => 'gtar',
),
 'application/x-hdf' =>
 array(
    0 => 'hdf',
),
 'application/x-install-instructions' =>
 array(
    0 => 'install',
),
 'application/x-iso9660-image' =>
 array(
    0 => 'iso',
),
 'application/x-java-jnlp-file' =>
 array(
    0 => 'jnlp',
),
 'application/x-latex' =>
 array(
    0 => 'latex',
),
 'application/x-lzh-compressed' =>
 array(
    0 => 'lzh',
    1 => 'lha',
),
 'application/x-mie' =>
 array(
    0 => 'mie',
),
 'application/x-mobipocket-ebook' =>
 array(
    0 => 'prc',
    1 => 'mobi',
),
 'application/x-ms-application' =>
 array(
    0 => 'application',
),
 'application/x-ms-shortcut' =>
 array(
    0 => 'lnk',
),
 'application/x-ms-wmd' =>
 array(
    0 => 'wmd',
),
 'application/x-ms-wmz' =>
 array(
    0 => 'wmz',
),
 'application/x-ms-xbap' =>
 array(
    0 => 'xbap',
),
 'application/x-msaccess' =>
 array(
    0 => 'mdb',
),
 'application/x-msbinder' =>
 array(
    0 => 'obd',
),
 'application/x-mscardfile' =>
 array(
    0 => 'crd',
),
 'application/x-msclip' =>
 array(
    0 => 'clp',
),
 'application/x-msdownload' =>
 array(
    0 => 'exe',
    1 => 'dll',
    2 => 'com',
    3 => 'bat',
    4 => 'msi',
),
 'application/x-msmediaview' =>
 array(
    0 => 'mvb',
    1 => 'm13',
    2 => 'm14',
),
 'application/x-msmetafile' =>
 array(
    0 => 'wmf',
    1 => 'wmz',
    2 => 'emf',
    3 => 'emz',
),
 'application/x-msmoney' =>
 array(
    0 => 'mny',
),
 'application/x-mspublisher' =>
 array(
    0 => 'pub',
),
 'application/x-msschedule' =>
 array(
    0 => 'scd',
),
 'application/x-msterminal' =>
 array(
    0 => 'trm',
),
 'application/x-mswrite' =>
 array(
    0 => 'wri',
),
 'application/x-netcdf' =>
 array(
    0 => 'nc',
    1 => 'cdf',
),
 'application/x-nzb' =>
 array(
    0 => 'nzb',
),
 'application/x-pkcs12' =>
 array(
    0 => 'p12',
    1 => 'pfx',
),
 'application/x-pkcs7-certificates' =>
 array(
    0 => 'p7b',
    1 => 'spc',
),
 'application/x-pkcs7-certreqresp' =>
 array(
    0 => 'p7r',
),
 'application/x-rar-compressed' =>
 array(
    0 => 'rar',
),
 'application/x-research-info-systems' =>
 array(
    0 => 'ris',
),
 'application/x-sh' =>
 array(
    0 => 'sh',
),
 'application/x-shar' =>
 array(
    0 => 'shar',
),
 'application/x-shockwave-flash' =>
 array(
    0 => 'swf',
),
 'application/x-silverlight-app' =>
 array(
    0 => 'xap',
),
 'application/x-sql' =>
 array(
    0 => 'sql',
),
 'application/x-stuffit' =>
 array(
    0 => 'sit',
),
 'application/x-stuffitx' =>
 array(
    0 => 'sitx',
),
 'application/x-subrip' =>
 array(
    0 => 'srt',
),
 'application/x-sv4cpio' =>
 array(
    0 => 'sv4cpio',
),
 'application/x-sv4crc' =>
 array(
    0 => 'sv4crc',
),
 'application/x-t3vm-image' =>
 array(
    0 => 't3',
),
 'application/x-tads' =>
 array(
    0 => 'gam',
),
 'application/x-tar' =>
 array(
    0 => 'tar',
),
 'application/x-tcl' =>
 array(
    0 => 'tcl',
),
 'application/x-tex' =>
 array(
    0 => 'tex',
),
 'application/x-tex-tfm' =>
 array(
    0 => 'tfm',
),
 'application/x-texinfo' =>
 array(
    0 => 'texinfo',
    1 => 'texi',
),
 'application/x-tgif' =>
 array(
    0 => 'obj',
),
 'application/x-ustar' =>
 array(
    0 => 'ustar',
),
 'application/x-wais-source' =>
 array(
    0 => 'src',
),
 'application/x-x509-ca-cert' =>
 array(
    0 => 'der',
    1 => 'crt',
),
 'application/x-xfig' =>
 array(
    0 => 'fig',
),
 'application/x-xliff+xml' =>
 array(
    0 => 'xlf',
),
 'application/x-xpinstall' =>
 array(
    0 => 'xpi',
),
 'application/x-xz' =>
 array(
    0 => 'xz',
),
 'application/x-zmachine' =>
 array(
    0 => 'z1',
    1 => 'z2',
    2 => 'z3',
    3 => 'z4',
    4 => 'z5',
    5 => 'z6',
    6 => 'z7',
    7 => 'z8',
),
 'application/xaml+xml' =>
 array(
    0 => 'xaml',
),
 'application/xcap-diff+xml' =>
 array(
    0 => 'xdf',
),
 'application/xenc+xml' =>
 array(
    0 => 'xenc',
),
 'application/xhtml+xml' =>
 array(
    0 => 'xhtml',
    1 => 'xht',
),
 'application/xml' =>
 array(
    0 => 'xml',
    1 => 'xsl',
),
 'application/xml-dtd' =>
 array(
    0 => 'dtd',
),
 'application/xop+xml' =>
 array(
    0 => 'xop',
),
 'application/xproc+xml' =>
 array(
    0 => 'xpl',
),
 'application/xslt+xml' =>
 array(
    0 => 'xslt',
),
 'application/xspf+xml' =>
 array(
    0 => 'xspf',
),
 'application/xv+xml' =>
 array(
    0 => 'mxml',
    1 => 'xhvml',
    2 => 'xvml',
    3 => 'xvm',
),
 'application/yang' =>
 array(
    0 => 'yang',
),
 'application/yin+xml' =>
 array(
    0 => 'yin',
),
 'application/zip' =>
 array(
    0 => 'zip',
),
 'audio/adpcm' =>
 array(
    0 => 'adp',
),
 'audio/basic' =>
 array(
    0 => 'au',
    1 => 'snd',
),
 'audio/midi' =>
 array(
    0 => 'mid',
    1 => 'midi',
    2 => 'kar',
    3 => 'rmi',
),
 'audio/mp4' =>
 array(
    0 => 'mp4a',
),
 'audio/mpeg' =>
 array(
    0 => 'mpga',
    1 => 'mp2',
    2 => 'mp2a',
    3 => 'mp3',
    4 => 'm2a',
    5 => 'm3a',
),
 'audio/ogg' =>
 array(
    0 => 'oga',
    1 => 'ogg',
    2 => 'spx',
),
 'audio/s3m' =>
 array(
    0 => 's3m',
),
 'audio/silk' =>
 array(
    0 => 'sil',
),
 'audio/vnd.dece.audio' =>
 array(
    0 => 'uva',
    1 => 'uvva',
),
 'audio/vnd.digital-winds' =>
 array(
    0 => 'eol',
),
 'audio/vnd.dra' =>
 array(
    0 => 'dra',
),
 'audio/vnd.dts' =>
 array(
    0 => 'dts',
),
 'audio/vnd.dts.hd' =>
 array(
    0 => 'dtshd',
),
 'audio/vnd.lucent.voice' =>
 array(
    0 => 'lvp',
),
 'audio/vnd.ms-playready.media.pya' =>
 array(
    0 => 'pya',
),
 'audio/vnd.nuera.ecelp4800' =>
 array(
    0 => 'ecelp4800',
),
 'audio/vnd.nuera.ecelp7470' =>
 array(
    0 => 'ecelp7470',
),
 'audio/vnd.nuera.ecelp9600' =>
 array(
    0 => 'ecelp9600',
),
 'audio/vnd.rip' =>
 array(
    0 => 'rip',
),
 'audio/webm' =>
 array(
    0 => 'weba',
),
 'audio/x-aac' =>
 array(
    0 => 'aac',
),
 'audio/x-aiff' =>
 array(
    0 => 'aif',
    1 => 'aiff',
    2 => 'aifc',
),
 'audio/x-caf' =>
 array(
    0 => 'caf',
),
 'audio/x-flac' =>
 array(
    0 => 'flac',
),
 'audio/x-matroska' =>
 array(
    0 => 'mka',
),
 'audio/x-mpegurl' =>
 array(
    0 => 'm3u',
),
 'audio/x-ms-wax' =>
 array(
    0 => 'wax',
),
 'audio/x-ms-wma' =>
 array(
    0 => 'wma',
),
 'audio/x-pn-realaudio' =>
 array(
    0 => 'ram',
    1 => 'ra',
),
 'audio/x-pn-realaudio-plugin' =>
 array(
    0 => 'rmp',
),
 'audio/x-wav' =>
 array(
    0 => 'wav',
),
 'audio/xm' =>
 array(
    0 => 'xm',
),
 'chemical/x-cdx' =>
 array(
    0 => 'cdx',
),
 'chemical/x-cif' =>
 array(
    0 => 'cif',
),
 'chemical/x-cmdf' =>
 array(
    0 => 'cmdf',
),
 'chemical/x-cml' =>
 array(
    0 => 'cml',
),
 'chemical/x-csml' =>
 array(
    0 => 'csml',
),
 'chemical/x-xyz' =>
 array(
    0 => 'xyz',
),
 'image/bmp' =>
 array(
    0 => 'bmp',
),
 'image/cgm' =>
 array(
    0 => 'cgm',
),
 'image/g3fax' =>
 array(
    0 => 'g3',
),
 'image/gif' =>
 array(
    0 => 'gif',
),
 'image/ief' =>
 array(
    0 => 'ief',
),
 'image/jpeg' =>
 array(
    0 => 'jpeg',
    1 => 'jpg',
    2 => 'jpe',
),
 'image/ktx' =>
 array(
    0 => 'ktx',
),
 'image/png' =>
 array(
    0 => 'png',
),
 'image/prs.btif' =>
 array(
    0 => 'btif',
),
 'image/sgi' =>
 array(
    0 => 'sgi',
),
 'image/svg+xml' =>
 array(
    0 => 'svg',
    1 => 'svgz',
),
 'image/tiff' =>
 array(
    0 => 'tiff',
    1 => 'tif',
),
 'image/vnd.adobe.photoshop' =>
 array(
    0 => 'psd',
),
 'image/vnd.dece.graphic' =>
 array(
    0 => 'uvi',
    1 => 'uvvi',
    2 => 'uvg',
    3 => 'uvvg',
),
 'image/vnd.dvb.subtitle' =>
 array(
    0 => 'sub',
),
 'image/vnd.djvu' =>
 array(
    0 => 'djvu',
    1 => 'djv',
),
 'image/vnd.dwg' =>
 array(
    0 => 'dwg',
),
 'image/vnd.dxf' =>
 array(
    0 => 'dxf',
),
 'image/vnd.fastbidsheet' =>
 array(
    0 => 'fbs',
),
 'image/vnd.fpx' =>
 array(
    0 => 'fpx',
),
 'image/vnd.fst' =>
 array(
    0 => 'fst',
),
 'image/vnd.fujixerox.edmics-mmr' =>
 array(
    0 => 'mmr',
),
 'image/vnd.fujixerox.edmics-rlc' =>
 array(
    0 => 'rlc',
),
 'image/vnd.ms-modi' =>
 array(
    0 => 'mdi',
),
 'image/vnd.ms-photo' =>
 array(
    0 => 'wdp',
),
 'image/vnd.net-fpx' =>
 array(
    0 => 'npx',
),
 'image/vnd.wap.wbmp' =>
 array(
    0 => 'wbmp',
),
 'image/vnd.xiff' =>
 array(
    0 => 'xif',
),
 'image/webp' =>
 array(
    0 => 'webp',
),
 'image/x-3ds' =>
 array(
    0 => '3ds',
),
 'image/x-cmu-raster' =>
 array(
    0 => 'ras',
),
 'image/x-cmx' =>
 array(
    0 => 'cmx',
),
 'image/x-freehand' =>
 array(
    0 => 'fh',
    1 => 'fhc',
    2 => 'fh4',
    3 => 'fh5',
    4 => 'fh7',
),
 'image/x-icon' =>
 array(
    0 => 'ico',
),
 'image/x-mrsid-image' =>
 array(
    0 => 'sid',
),
 'image/x-pcx' =>
 array(
    0 => 'pcx',
),
 'image/x-pict' =>
 array(
    0 => 'pic',
    1 => 'pct',
),
 'image/x-portable-anymap' =>
 array(
    0 => 'pnm',
),
 'image/x-portable-bitmap' =>
 array(
    0 => 'pbm',
),
 'image/x-portable-graymap' =>
 array(
    0 => 'pgm',
),
 'image/x-portable-pixmap' =>
 array(
    0 => 'ppm',
),
 'image/x-rgb' =>
 array(
    0 => 'rgb',
),
 'image/x-tga' =>
 array(
    0 => 'tga',
),
 'image/x-xbitmap' =>
 array(
    0 => 'xbm',
),
 'image/x-xpixmap' =>
 array(
    0 => 'xpm',
),
 'image/x-xwindowdump' =>
 array(
    0 => 'xwd',
),
 'message/rfc822' =>
 array(
    0 => 'eml',
    1 => 'mime',
),
 'model/iges' =>
 array(
    0 => 'igs',
    1 => 'iges',
),
 'model/mesh' =>
 array(
    0 => 'msh',
    1 => 'mesh',
    2 => 'silo',
),
 'model/vnd.collada+xml' =>
 array(
    0 => 'dae',
),
 'model/vnd.dwf' =>
 array(
    0 => 'dwf',
),
 'model/vnd.gdl' =>
 array(
    0 => 'gdl',
),
 'model/vnd.gtw' =>
 array(
    0 => 'gtw',
),
 'model/vnd.mts' =>
 array(
    0 => 'mts',
),
 'model/vnd.vtu' =>
 array(
    0 => 'vtu',
),
 'model/vrml' =>
 array(
    0 => 'wrl',
    1 => 'vrml',
),
 'model/x3d+binary' =>
 array(
    0 => 'x3db',
    1 => 'x3dbz',
),
 'model/x3d+vrml' =>
 array(
    0 => 'x3dv',
    1 => 'x3dvz',
),
 'model/x3d+xml' =>
 array(
    0 => 'x3d',
    1 => 'x3dz',
),
 'text/cache-manifest' =>
 array(
    0 => 'appcache',
),
 'text/calendar' =>
 array(
    0 => 'ics',
    1 => 'ifb',
),
 'text/css' =>
 array(
    0 => 'css',
),
 'text/csv' =>
 array(
    0 => 'csv',
),
 'text/html' =>
 array(
    0 => 'html',
    1 => 'htm',
),
 'text/n3' =>
 array(
    0 => 'n3',
),
 'text/plain' =>
 array(
    0 => 'txt',
    1 => 'text',
    2 => 'conf',
    3 => 'def',
    4 => 'list',
    5 => 'log',
    6 => 'in',
),
 'text/prs.lines.tag' =>
 array(
    0 => 'dsc',
),
 'text/richtext' =>
 array(
    0 => 'rtx',
),
 'text/sgml' =>
 array(
    0 => 'sgml',
    1 => 'sgm',
),
 'text/tab-separated-values' =>
 array(
    0 => 'tsv',
),
 'text/troff' =>
 array(
    0 => 't',
    1 => 'tr',
    2 => 'roff',
    3 => 'man',
    4 => 'me',
    5 => 'ms',
),
 'text/turtle' =>
 array(
    0 => 'ttl',
),
 'text/uri-list' =>
 array(
    0 => 'uri',
    1 => 'uris',
    2 => 'urls',
),
 'text/vcard' =>
 array(
    0 => 'vcard',
),
 'text/vnd.curl' =>
 array(
    0 => 'curl',
),
 'text/vnd.curl.dcurl' =>
 array(
    0 => 'dcurl',
),
 'text/vnd.curl.scurl' =>
 array(
    0 => 'scurl',
),
 'text/vnd.curl.mcurl' =>
 array(
    0 => 'mcurl',
),
 'text/vnd.dvb.subtitle' =>
 array(
    0 => 'sub',
),
 'text/vnd.fly' =>
 array(
    0 => 'fly',
),
 'text/vnd.fmi.flexstor' =>
 array(
    0 => 'flx',
),
 'text/vnd.graphviz' =>
 array(
    0 => 'gv',
),
 'text/vnd.in3d.3dml' =>
 array(
    0 => '3dml',
),
 'text/vnd.in3d.spot' =>
 array(
    0 => 'spot',
),
 'text/vnd.sun.j2me.app-descriptor' =>
 array(
    0 => 'jad',
),
 'text/vnd.wap.wml' =>
 array(
    0 => 'wml',
),
 'text/vnd.wap.wmlscript' =>
 array(
    0 => 'wmls',
),
 'text/x-asm' =>
 array(
    0 => 's',
    1 => 'asm',
),
 'text/x-c' =>
 array(
    0 => 'c',
    1 => 'cc',
    2 => 'cxx',
    3 => 'cpp',
    4 => 'h',
    5 => 'hh',
    6 => 'dic',
),
 'text/x-fortran' =>
 array(
    0 => 'f',
    1 => 'for',
    2 => 'f77',
    3 => 'f90',
),
 'text/x-java-source' =>
 array(
    0 => 'java',
),
 'text/x-opml' =>
 array(
    0 => 'opml',
),
 'text/x-pascal' =>
 array(
    0 => 'p',
    1 => 'pas',
),
 'text/x-php' =>
 array(
    0 => 'php',
    1 => 'phtml',
    2 => 'php3',
    3 => 'php4',
    4 => 'php5',
    5 => 'php7',
    6 => 'phps',
),
 'text/x-nfo' =>
 array(
    0 => 'nfo',
),
 'text/x-setext' =>
 array(
    0 => 'etx',
),
 'text/x-sfv' =>
 array(
    0 => 'sfv',
),
 'text/x-uuencode' =>
 array(
    0 => 'uu',
),
 'text/x-vcalendar' =>
 array(
    0 => 'vcs',
),
 'text/x-vcard' =>
 array(
    0 => 'vcf',
),
 'video/3gpp' =>
 array(
    0 => '3gp',
),
 'video/3gpp2' =>
 array(
    0 => '3g2',
),
 'video/h261' =>
 array(
    0 => 'h261',
),
 'video/h263' =>
 array(
    0 => 'h263',
),
 'video/h264' =>
 array(
    0 => 'h264',
),
 'video/jpeg' =>
 array(
    0 => 'jpgv',
),
 'video/jpm' =>
 array(
    0 => 'jpm',
    1 => 'jpgm',
),
 'video/mj2' =>
 array(
    0 => 'mj2',
    1 => 'mjp2',
),
 'video/mp4' =>
 array(
    0 => 'mp4',
    1 => 'mp4v',
    2 => 'mpg4',
),
 'video/mpeg' =>
 array(
    0 => 'mpeg',
    1 => 'mpg',
    2 => 'mpe',
    3 => 'm1v',
    4 => 'm2v',
),
 'video/ogg' =>
 array(
    0 => 'ogv',
),
 'video/quicktime' =>
 array(
    0 => 'qt',
    1 => 'mov',
),
 'video/vnd.dece.hd' =>
 array(
    0 => 'uvh',
    1 => 'uvvh',
),
 'video/vnd.dece.mobile' =>
 array(
    0 => 'uvm',
    1 => 'uvvm',
),
 'video/vnd.dece.pd' =>
 array(
    0 => 'uvp',
    1 => 'uvvp',
),
 'video/vnd.dece.sd' =>
 array(
    0 => 'uvs',
    1 => 'uvvs',
),
 'video/vnd.dece.video' =>
 array(
    0 => 'uvv',
    1 => 'uvvv',
),
 'video/vnd.dvb.file' =>
 array(
    0 => 'dvb',
),
 'video/vnd.fvt' =>
 array(
    0 => 'fvt',
),
 'video/vnd.mpegurl' =>
 array(
    0 => 'mxu',
    1 => 'm4u',
),
 'video/vnd.ms-playready.media.pyv' =>
 array(
    0 => 'pyv',
),
 'video/vnd.uvvu.mp4' =>
 array(
    0 => 'uvu',
    1 => 'uvvu',
),
 'video/vnd.vivo' =>
 array(
    0 => 'viv',
),
 'video/webm' =>
 array(
    0 => 'webm',
),
 'video/x-f4v' =>
 array(
    0 => 'f4v',
),
 'video/x-fli' =>
 array(
    0 => 'fli',
),
 'video/x-flv' =>
 array(
    0 => 'flv',
),
 'video/x-m4v' =>
 array(
    0 => 'm4v',
),
 'video/x-matroska' =>
 array(
    0 => 'mkv',
    1 => 'mk3d',
    2 => 'mks',
),
 'video/x-mng' =>
 array(
    0 => 'mng',
),
 'video/x-ms-asf' =>
 array(
    0 => 'asf',
    1 => 'asx',
),
 'video/x-ms-vob' =>
 array(
    0 => 'vob',
),
 'video/x-ms-wm' =>
 array(
    0 => 'wm',
),
 'video/x-ms-wmv' =>
 array(
    0 => 'wmv',
),
 'video/x-ms-wmx' =>
 array(
    0 => 'wmx',
),
 'video/x-ms-wvx' =>
 array(
    0 => 'wvx',
),
 'video/x-msvideo' =>
 array(
    0 => 'avi',
),
 'video/x-sgi-movie' =>
 array(
    0 => 'movie',
),
 'video/x-smv' =>
 array(
    0 => 'smv',
),
 'x-conference/x-cooltalk' =>
 array(
    0 => 'ice',
),
    ) as $m => $a) {
        if (in_array($ext, $a)) {
            return $m;
        }
    }
    return 'application/octet-stream';
}
