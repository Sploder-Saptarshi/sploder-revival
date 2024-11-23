<?php include('php/verify.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />


    <?php include('../../content/onlinecheck.php'); ?>

</head>
<?php include('../../content/addressbar.php'); ?>

<body id="everyones" class="featured">
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
            <h2>Ban member</h2>
            <p>The user will be prevented from making comments or creating new games.</p>
            <form action="php/ban.php" method="post">

                <input type="text" name="username" id="username" placeholder="Username" required />
                <input style="width: 150px;" type="number" min="0" name="time" id="username"
                    placeholder="Time (in days)" required />
                <input type="submit" value="Ban" />
                <div class="spacer">&nbsp;</div><br>

                <textarea name="reason" id="reason" placeholder="Reason" rows="4" cols="50" required></textarea>


            </form>
            <br><br>

            <h2>Unban member</h2>
            <p>The user will have their ban removed.</p>
            <form action="php/unban.php" method="post">

                <input type="text" name="username" id="username" placeholder="Username" required /> <input type="submit"
                    value="Unban" />
                <br><br>



            </form>

            <h2>Delete game</h2>
            <p>WARNING: THIS WILL PERMANENTLY DELETE THE GAME FROM THE DATABASE<br>
                THIS ACTION CAN ONLY BE UNDONE BY THE DATABASE ADMINISTRATOR<br>
                3 moderators must opt to delete a game to proceed.<br>
                Check pending deletions to see games that need to be deleted.<br>
                If a game is inactive for 14 days, the game will be removed from pending deletion.
            </p>
            <form action="php/delete.php" method="post">

                <input style="width: 350px;" type="text" name="url" id="username" placeholder="Enter game URL"
                    required /> <input type="submit" value="Delete" />
                <div class="spacer">&nbsp;</div><br>

                <textarea name="reason" id="reason" placeholder="Reason" rows="4" cols="50" required></textarea>
                <input type="submit" name="return" hidden value="index.php" />

            </form>

            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">






            <h3>BE VERY CAREFUL WHILE USING THIS PANEL<br>DUE TO LAZINESS THERE PROBABLY WILL BE NO BACKUPS.</h3>

            <br><br>
            <h2>Set boost points</h2>
            <form action="php/setbp.php" method="post">

                <input type="text" name="username" id="username" placeholder="Username" required />
                <div class="spacer">&nbsp;</div><br>
                <input style="width: 100px;" type="number" min="0" name="bp" id="username" placeholder="Boost points"
                    required /> <input type="submit" value="Set" />
            </form>
            <br><br>
            <h2>Get boost points</h2>
            <form action="php/getbp.php" method="post">

                <input type="text" name="username" id="username" placeholder="Username" required />

                <input type="submit" value="Get" />


            </form>
            <?php if (isset($_GET['bp'])) {
        echo "<h2>Results</h2>";
        echo "<p>Boost points: " . $_GET['bp'] . "</p>";
      }
      ?>
            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../../content/footernavigation.php'); ?>
</body>

</html>