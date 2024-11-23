<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the list of staff members
require_once('../database/connect.php');
$db = getDatabase();
// Get all members who have permission that is not null as well as not just blank in a random order
$sql = "SELECT username FROM members WHERE perms IS NOT NULL AND perms != '' ORDER BY RANDOM()";
$names = $db->query($sql);
// Echo each name in the format of name,nextname
// Last name does not have a comma
$output = "";
foreach ($names as $name) {
    $output .= $name['username'] . ",";
}
echo rtrim($output, ",");