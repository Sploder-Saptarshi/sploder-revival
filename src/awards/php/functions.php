<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Common functions for awards

function getLevel () {
    // Import database connection
    require_once('../database/connect.php');
    // Get user level
    $db = connectToDatabase();
    $qs = "SELECT level FROM members WHERE username = :username";
    $statement = $db->prepare($qs);
    $statement->execute([':username' => $_SESSION['username']]);
    $result = $statement->fetchAll();
    return $result[0]['level'];
}
function isEditor() {
    // Check whether user is editor
    require_once('../database/connect.php');
    $db = connectToDatabase();
    $qs = "SELECT perms FROM members WHERE username = :username";
    $statement = $db->prepare($qs);
    $statement->execute([':username' => $_SESSION['username']]);
    $result = $statement->fetchAll();
    // Check whether the letter "E" exists in perms
   return str_contains($result[0]['perms'], "E");
}
function getMaxCustomization ($level, $isEditor) {
    

    $maxCustomization = 0;
    // If level is 10 or more, set maxCustomization to 1
    // If level is 25 or more, set maxCustomization to 3
    // If level is 50 or more, set maxCustomization to 6
    // If user is an editor, set maxCustomization to 7
    if ($level >= 50) {
        $maxCustomization = 6;
    } else if ($level >= 25) {
        $maxCustomization = 3;
    } else if ($level >= 10) {
        $maxCustomization = 1;
    }
    if ($isEditor) {
        $maxCustomization = 7;
    }
    return "[" . $maxCustomization . "," . $maxCustomization . "," . $maxCustomization . "," . $maxCustomization . "," . $maxCustomization . "," . $maxCustomization . "]";

}