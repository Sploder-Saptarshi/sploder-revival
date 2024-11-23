<?php
$url = $_POST["url"];
$domain = substr($url, 0, 20);
$back = str_replace("&urlerr=1", "", str_replace("&err404=1", "", $_POST["back"]));
$file = $url;
$file_headers = @get_headers($file);
if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $err404 = true;
} else {
    $err404 = false;
}
echo $file_headers;
if (($domain == "https://sploder.xyz/") && ($err404 == false)) {
    header("Location: " . $url);
} elseif ($domain !== "https://sploder.xyz/") {
    header("Location: " . $back . "&urlerr=1");
} elseif ($err404 == true) {
    header("Location: " . $back . "&err404=1");
}