<?php
header('content-type: text/plain');
$p = $_GET['pubkey'];
echo "&u=1&c=1&m=" . $p . "&tv=0&a=1";