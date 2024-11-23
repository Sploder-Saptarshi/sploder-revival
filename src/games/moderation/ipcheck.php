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

    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />


    <?php include('../../content/onlinecheck.php'); ?>

</head>
<?php include('../../content/addressbar.php'); ?>

<body id="everyones" class="newest">
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
            <h2>Check all usernames sharing the same IP address</h2>

            <form action="ipcheck.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Enter username" required />
                <input type="submit" value="Check" />
            </form>
            <?php if (isset($_POST['username'])): ?>
            <h2>Results</h2>
            <?php
                $username = $_POST['username'];
                $sql = "SELECT ip_address FROM members WHERE username = :username";
                $statement = $db_old->prepare($sql);
                $statement->execute([
                    ':username' => $username
                ]);
                $ip_address = $statement->fetchColumn();
                if ($ip_address) {
                    $sql = "SELECT username FROM members WHERE ip_address = :ip_address AND username != :username";
                    $statement = $db_old->prepare($sql);
                    $statement->execute([
                        ':ip_address' => $ip_address,
                        ':username' => $username
                    ]);
                    $usernames = $statement->fetchAll();
                    if (count($usernames) == 0) {
                        echo "<p>No other usernames share the same IP address</p>";
                    } else {
                        echo "<p>Other usernames sharing the same IP address:</p>";
                        echo "<ul>";
                        foreach ($usernames as $username) {
                            echo "<li>" . htmlspecialchars($username['username']) . "</li>";
                        }
                        echo "</ul>";
                    }
                } else {
                    echo "<p>Username not found</p>";
                }
            endif;
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