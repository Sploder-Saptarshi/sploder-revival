<?php
header('Content-Type: text/xml');
session_id($_GET['PHPSESSID']);
session_start();
$data = file_get_contents("php://input");
$id = (int)filter_var(substr($_GET['projid'], 4), FILTER_SANITIZE_NUMBER_INT);
$size = $_GET['size'];
$image_path = "../users/user" . $_SESSION['userid'] . "/images/proj" . $id . "/";
if ($size == "small") {
	file_put_contents($image_path . "thumbnail.png", $data);
} else {
	file_put_contents($image_path . "image.png", $data);
}
echo '<message result="success"/>';