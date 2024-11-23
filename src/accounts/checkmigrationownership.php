<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
# Including all the required scripts for demo
require __DIR__ . "/discord.php";
require __DIR__ . "/functions.php";
require  __DIR__ . "/config.php";

# Initializing all the required values for the script to work
init($redirect_url, $client_id, $secret_id, $bot_token);

# Fetching user details | (identify scope) (optionally email scope too if you want user's email) [Add identify AND email scope for the email!]
get_user();

# Uncomment this for using it WITH email scope and comment line 32.
#get_user($email=True);

# Fetching user connections | (connections scope)
session_Start();
if (!isset($_SESSION['user_id'])) {
    header('Location: register.php?err=can');
}
session_regenerate_id();
$db = new PDO('sqlite:../database/originalmembers.db');
$qs2 = "SELECT username FROM members WHERE userid=:userid";
$statement2 = $db->prepare($qs2);
$statement2->execute([
    ':userid' => $_SESSION['user_id']
]);
$result2 = $statement2->fetchAll();
if (!isset($_GET["err"])) {
    if (isset($result2[0])) {
        print_r($result2[0]);
        if ($_SESSION['enteredusername'] == $result2[0]['username']) {
            header('Location: registerpassword.php');
            $_SESSION['usermigrate'] = "true";
        } else {
            header('Location: register.php?err=dis');
        }
    }
}