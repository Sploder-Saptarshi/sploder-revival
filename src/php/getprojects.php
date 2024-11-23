<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_id($_GET['PHPSESSID']);
session_start();
header("Content-type: text/xml");
if (isset($_SESSION['PHPSESSID'])) { // session ID is valid and exists
	$author = $_SESSION["username"];
	include('../database/connect.php');
	$db = connectToDatabase();
	$queryString = 'SELECT * FROM games WHERE author = :author AND g_swf = :g_swf AND isdeleted = :isdeleted ORDER BY "g_id"';
	$statement = $db->prepare($queryString);
	$statement->execute([
		':g_swf' => $_GET['version'],
		':author' => $author,
		':isdeleted' => '0'
	]);
	$result = $statement->fetchAll();
	$resultTotal = count($result);
	$f = '20';
	if (isset($_GET['start'])) {
		$start = $_GET['start'];
	}
	$num = $resultTotal;


	if (in_array($_GET['version'],
		["5", "3", "7"]
	)) {
		$string = '<projects total="' . $resultTotal . '" start="' . $start . '" num="' . $num . '">';
	} else {
		$num = $resultTotal;
		$string = '<projects total="' . $resultTotal . '">';
	}

	$i = $num - 1;
	while ($i >= 0) {
		$string .= '<project id="proj' . $result[$i]['g_id'] . '" src="proj' . $result[$i]['g_id'] . '.xml" title="' . $result[$i]['title'] . '" date="' . date("l, F jS, Y", strtotime($f . $result[$i]['date'])) . '" time="' . strtotime($f . $result[$i]['date']) . '" archived="0" />';
		$i--;
	}
	$string .= '</projects>';
	print($string);
} else {
	if ($_GET['version'] == "7") {
		echo '<projects total="1" start="0" num="10"><project id="notset" src="notset" title="No demo games for you mwahahaha" time="157774694400" archived="0"/></projects>';
	} elseif ($_GET['PHPSESSID'] != "demo") {
		echo '<projects total="1" start="0" num="10"><project id="notset" src="notset" title="The session ID is incorrect!" date="Log out and log in again." archived="0"/></projects>';
	} else {
		echo '<projects total="1" start="0" num="10"><project id="notset" src="notset" title="The creator is in demo mode!" date="Loading is disabled." archived="0"/></projects>';
	}
}