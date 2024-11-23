<?php
header('Content-Type: image/png');
echo file_get_contents('https://www.avatar.nem-creator.com/' . $_GET['c'])