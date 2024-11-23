<?php
function getVisitorIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check if IP is from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check if IP is passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Default remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}