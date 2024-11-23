<?php include('php/verify.php'); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../../content/head.php'); ?>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />


    <?php include('../../content/onlinecheck.php'); ?>

</head>
<?php include('../../content/addressbar.php'); ?>

<body id="everyones" class="reviews">
    <?php include('../../content/headernavigation.php'); ?>

    <div id="page">
        <?php include('content/subnav.php'); ?>

        <div id="content">
            <?php if (isset($_GET['err'])): ?>
            <p class="alert"><?= htmlspecialchars($_GET['err']) ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['msg'])): ?>
            <p class="prompt"><?= htmlspecialchars($_GET['msg']) ?></p>
            <?php endif; ?>
            <h2>List of all banned members</h2>

            <?php
            require_once('content/getbans.php');
            if (count($bans) == 0) {
                echo "<p>No members are currently banned</p>";
            } else {
                echo "<table>";
                echo "<tr><th>Username</th><th>Reason</th><th>Time (days)</th><th>Action</th></tr>";
                foreach ($bans as $ban) {
                    echo "<tr><td>" . $ban['username'] . "</td><td>" . $ban['reason'] . "</td><td>" . ($ban['autounbandate'] - $ban['bandate']) / 86400, "</td><td><a href='php/unban.php?username=" . $ban['username'] . "'>Unban</a></td></tr>";
                }
                echo "</table>";
            }
            ?>


            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">


            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../../content/footernavigation.php'); ?>
</body>

</html>