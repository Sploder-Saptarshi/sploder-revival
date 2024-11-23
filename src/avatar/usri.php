<?php

header('Content-Type: image/png');

$user = $_GET['u'];
$db = new PDO('sqlite:../db/members.db');
$offset = 12;
$queryString = 'SELECT * FROM members WHERE username = "' . $user . '"';
$statement = $db->prepare($queryString);
$statement->execute();
$result = $statement->fetchAll();
$qTotal = "SELECT count(1) FROM members WHERE username = '" . $user . "'";
$staTotal = $db->prepare($qTotal);
$staTotal->execute();
$resultTotal = $staTotal->fetchAll();
$resultTotal = $resultTotal[0][0];
$image = file_get_contents('https://www.avatar.nem-creator.com/' . $result[0]['avatar']);
echo $image