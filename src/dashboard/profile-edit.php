<?php include('../content/logincheck.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/members.css" />
    <style media="screen" type="text/css">
    #swfhttpobj {
        visibility: hidden
    }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>


    <link href="/css/members.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="Javascript">
    <!-- //
    var flashLoaded = false;

    function doLoad() {
        if (!flashLoaded) {
            try {
                so.write("flashcontent");
            } catch (e) {}
            flashLoaded = true;
        }
    }

    setTimeout("doLoad()", 2000);

    //
    -->
    </script>
    <?php include('../content/onlinecheck.php'); ?>
</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="" onload="doLoad();">
    <?php include('../content/headernavigation.php'); ?>
    <div id="page">
        <div id="subnav">
            <ul class="nav_dashboard">
                <li><a href="/">Home</a></li>
                <li><a href="my-games.php">My Games</a></li>
                <li><a href="" class="active">Profile</a></li>
                <li><a href="/friends/index.php">Friends</a></li>
                <li><a href="groups/">Groups</a></li>
                <li><a href="/awards/index.php">Awards</a></li>
                <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
                <li><a href="my-graphics.php">Graphics</a></li>
                <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
            </ul>
        </div>
        <div id="content">
            <h3>Edit Profile</h3>
            <div id="venue" style="margin: -30px 0 -5px 20px; float: right;"></div>



            <p>Enter some info about you that you would like to appear on your profile.<br>This information will be
                visible to everyone on your public profile. Leave a field <strong>blank</strong> if you do not wish for
                it to appear on your profile.</p>


            <div class="buttons" style="padding: 0;">
                <span class="button firstbutton"><a href="/accounts/avatar.php">Edit your avatar
                        &raquo;</a></span>&nbsp;
                <span class="button"><a href="/members/index.php?u=<?php echo $_SESSION['username'] ?>">View your public
                        profile &raquo;</a></span>&nbsp;
                <br><br>
            </div>

            <div class="spacer">&nbsp;</div>

            <div class="spacer">&nbsp;</div>


            <form action="profile-update.php" method="post">
                <label for="description">Description:</label><br><br>
                <textarea id="description" name="description" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter a description about yourself..."></textarea><br><br><br>
                <label for="hobbies">Hobbies:</label><br><br>
                <textarea id="hobbies" name="hobbies" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter your hobbies..."></textarea><br><br><br>
                <label for="favoriteSports">Favorite Sports:</label><br><br>
                <textarea id="favoriteSports" name="favoriteSports" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter your favorite sports..."></textarea><br><br><br>
                <label for="favoriteGames">Favorite Games:</label><br><br>
                <textarea id="favoriteGames" name="favoriteGames" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter your favorite games..."></textarea><br><br><br>
                <label for="favoriteMovies">Favorite Movies:</label><br><br>
                <textarea id="favoriteMovies" name="favoriteMovies" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter your favorite movies..."></textarea><br><br><br>
                <label for="favoriteBands">Favorite Bands:</label><br><br>
                <textarea id="favoriteBands" name="favoriteBands" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter your favorite bands..."></textarea><br><br><br>
                <label for="whomIRespect">Whom You Respect:</label><br><br>
                <textarea id="whomIRespect" name="whomIRespect" rows="3" style="width: 100%; resize: none;"
                    placeholder="Enter whom you respect..."></textarea><br><br><br>
                <input type="submit" value="Submit" style="height: 40px" class="postbutton">
            </form>
        </div>
        <div id="sidebar">

            <script type="text/javascript">
            window.onload = function() {
                var n;
                n = document.createElement('link');
                n.rel = 'stylesheet';
                n.type = 'text/css';
                n.href = '../css/venue5.css';
                document.getElementsByTagName('head')[0].appendChild(n);
                n = document.createElement('script');
                n.type = 'text/javascript';
                n.src = 'https://web.archive.org/web/20140608214730/http://sploder.us/dashboard6.js';
                document.getElementsByTagName('head')[0].appendChild(n);
                if (onload2) onload2();
            }
            </script>
            <?php include('../content/onlinelist.php') ?>


            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div><?php include('../content/footernavigation.php') ?>
</body>

</html>