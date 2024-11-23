<?php
if (!isset($_SESSION)) {
    session_start();
}
require __DIR__ . "/functions.php";
require __DIR__ . "/discord.php";
require __DIR__ . "/config.php";
$auth_url = url($client_id, $redirect_url, $scopes);

$auth_url = url($client_id, $redirect_url, $scopes);