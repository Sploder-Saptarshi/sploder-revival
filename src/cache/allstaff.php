<?php
require_once(__DIR__ . "/../database/connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db1 = getSqliteMembers();
$thing = "SELECT username,perms FROM members WHERE perms IS NOT NULL";
$bp = $db1->query($thing);
for($i=0;$i<count($bp);$i++){
    echo $bp[$i]['username'];
    if($i!=count($bp)-1){
        echo ",";
    }
}

?>
