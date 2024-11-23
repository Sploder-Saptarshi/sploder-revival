<?php

$username = $_GET['u'];
// Check file exists php
if (file_exists('../avatar/a/' . $username . '.png')) {
    $raw = file_get_contents('../avatar/a/' . $username . '.png');
    echo $raw;
} else {
    echo file_get_contents('../avatar/a/fb/noob.png');
}