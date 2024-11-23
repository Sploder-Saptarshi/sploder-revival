<?php
include('getip.php');
function error_found()
{
    header("Location: register.php?err=unk");
}
// set_error_handler('error_found');
$captcha = $_POST['cf-turnstile-response'];

if (!$captcha) {
    // What happens when the CAPTCHA was entered incorrectly
    header('Location: register.php?err=cap');
    exit;
}

$ip = getVisitorIp();
require_once('../config/env.php');
$secretKey = getenv("CF_TURNSTILE_SECRET_KEY");

$url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
$data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);

$options = array(
    'http' => array(
        'header' => "Content-Type: application/x-www-form-urlencoded",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$stream = stream_context_create($options);

$result = file_get_contents(
    $url_path,
    false,
    $stream
);

$response =  $result;

$responseKeys = json_decode($response, true);
//print_r ($responseKeys);
if (intval($responseKeys["success"]) !== 1) {
    header('Location: register.php?err=cap');
} else {
    session_start();
    $password = $_POST['pass2'];
    $isolate = $_POST['social'];
    $tostest = $_POST['tostest'];
    $username = mb_strtolower($_SESSION['enteredusername']);
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    if ($isolate == "1") {
        $isolate == "0";
    } else {
        $isolate == "1";
    }
    $t = time();
    if ($tostest == "1") {
        $db = new PDO('sqlite:../database/originalmembers.db');

        $qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
        $statement2 = $db->prepare($qs2);
        $statement2->execute(
            [
                ':user' => $username
            ]
        );

        $result2 = $statement2->fetchAll();
        include('../database/connect.php');
        $db = connectToDatabase('members');
        #$qs = "UPDATE sploder SET isprivate=" . $isprivate . " WHERE g_id = " . $id;
        $qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
        $statement2 = $db->prepare($qs2);
        $statement2->execute(
            [
                ':user' => $username
            ]
        );
        $result3 = $statement2->fetchAll();
        if (isset($result3[0]['username'])) {
            $status1 = "cant";
        } else {
            $status1 = "can";
        }
        if ($status1 == "can") {
            if (isset($result2[0]['username'])) {
                $status = "alert";
            } else {
                $status = "green";
            }
            if ($status == "alert") {
                if ($_SESSION['enteredusername'] == $result2[0]['username']) {
                    $qs = "INSERT INTO members (username, password, joindate, lastlogin, isolate, level, boostpoints, lastpagechange) VALUES (:username, :password, :join, :lastlogin, :isolate, :level, :boostpoints, :lastpagechange)";
                    $statement = $db->prepare($qs);
                    $statement->execute([
                        ':username' => $username,
                        ':password' => $hashed,
                        ':join' => $t,
                        ':lastlogin' => $t,
                        ':isolate' => $isolate,
                        ':level' => '1',
                        ':boostpoints' => '250',
                        ':lastpagechange' => '0',
                        ':ip_address' => $ip
                    ]);
                    session_destroy();
                    header('Location: registersuccess.php');
                }
            } elseif ($status == "green") {
                $length = strlen($username);
                if ((2 < $length) && ($length < 17)) {
                    $qs = "INSERT INTO members (username, password, joindate, lastlogin, isolate, level, boostpoints, lastpagechange, ip_address) VALUES (:username, :password, :join, :lastlogin, :isolate, :level, :boostpoints, :lastpagechange, :ip_address)";
                    $statement = $db->prepare($qs);
                    $statement->execute([
                        ':username' => $username,
                        ':password' => $hashed,
                        ':join' => $t,
                        ':lastlogin' => $t,
                        ':isolate' => $isolate,
                        ':level' => '1',
                        ':boostpoints' => '250',
                        ':lastpagechange' => '0',
                        ':ip_address' => $ip
                    ]);
                    session_destroy();
                    header('Location: registersuccess.php');
                } else {
                }
            }
        } else {
        }
    }
}