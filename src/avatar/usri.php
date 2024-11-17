<?php 
require_once(__DIR__ . "/../database/connect.php");

    header('Content-Type: image/png');

$user = $_GET['u'];
$db = getSqliteMembers();
$offset = 12;
// TODO:: pass in user as parameter to prevent injection
$queryString = 'SELECT * FROM members WHERE username = "' . $user . '"';
$result = $db->query($queryString);
$qTotal = "SELECT count(1) FROM members WHERE username = '" . $user . "'";
$staTotal = $db->query($qTotal);
$resultTotal = $resultTotal[0][0];
$image = file_get_contents('https://www.avatar.nem-creator.com/'.$result[0]['avatar']);
echo $image

?>
