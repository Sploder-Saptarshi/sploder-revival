<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.sploder.com/css/sploder_v2p22.min.css" />

    <?php include('../content/head.php'); ?>




    <script type="text/javascript">
    <!--
    var userid = "demo";

    var page_start_time = (new Date()).getTime();



    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height)

    {



        if (popUpWin)

        {

            if (!popUpWin.closed) popUpWin.close();

        }

        popUpWin = open(URLStr, '_blank',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width=' +
            width + ',height=' + height + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' +
            top + '');

    }



    function setup_exit() {

        if (userid != "demo") {

            window.onbeforeunload = function() {

                if ((new Date()).getTime() - page_start_time > 5000)
                return "If you exit thisl page you will lose any unsaved work.";

            };

        }

    }





    function getPhotos() {

        popUpWindow("php/uploadform.php?PHPSESSID=", Math.floor(screen.width / 2) - 275, Math.floor(screen.height / 2) -
            225, 550, 450);

    }



    function launchHelp() {

        popUpWindow("help_inline.php?PHPSESSID=", Math.floor(screen.width / 2) - 275, Math.floor(screen.height / 2) -
            225, 550, 450);

    }



    function playMovie(movieID, userID, creationDate, wide) {

        if ((wide == null) | (wide < 660)) {

            wide = 660;

        } else if (wide > screen.width) {

            wide = screen.width - 20;

        }

        popUpWindow("/php/player.php?PHPSESSID=&m=" + movieID + "&u=" + userID + "&c=" + creationDate, Math.floor(screen
            .width / 2) - (wide / 2), Math.floor(screen.height / 2) - 200, wide, 400);

    }



    function playPubMovie(pubkey, wide) {

        if ((wide == null) | (wide < 660)) {

            wide = 660;

        } else if (wide > screen.width) {

            wide = screen.width - 20;

        }

        popUpWindow("/publish.php?PHPSESSID=&s=" + pubkey + "#kickdown", Math.floor(screen.width / 2) - (wide / 2), Math
            .floor(screen.height / 2) - 270, wide, 540);

    }



    function updateMovie(value) {

        var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

        if (InternetExplorer) {

            document.creator.SetVariable("/browsermanager:callvalue", value);

            document.creator.TPlay("browsermanager");

        } else {

            document.creator.SetVariable("/browsermanager:callvalue", value);

            document.creator.TPlay("browsermanager");

        }

    }



    setup_exit();

    var flashvars = {
        PHPSESSID: "",
        userid: "demo",
        username: "demo",
        creationdate: "20070102003743"
    };

    var params = {
        menu: "false",
        quality: "high",
        scale: "noscale",
        salign: "tl",
        bgcolor: "#333333",
        base: "https://www.sploder.com"
    };

    var attributes = {
        v: "1"
    };

    swfobject.embedSWF("creator3_b03.swf", "flashcontent", "720", "540", "10", "/swfobject/expressInstall.swf",
        flashvars, params);
    -->
    </script>


    <script type="text/javascript">
    if (userid != "demo") {
        window.onbeforeunload = function() {
            return "Are you sure you want to navigate away from this page?";
        }
    }
    </script>

</head>
<?php include('content/addressbar.php'); ?>

<body id="creator" class="threedee">
    <?php include('../content/headernavigation.php'); ?>



    <div id="page">
        <?php include('../content/subnav.php'); ?>


        <div id="content">
            <h3>3d Game Maker, Space Adventure</h3>

            <div id="creatorcontainer">
                <div id="flashcontent">
                    <div style="margin: 40px auto; text-align: center; width: 420px;">
                        <p>Make your own 3d space adventure game with this game maker. Create a 3d space station and add
                            aliens, robots, traps and powerups to create your own space missions.</p>
                        The Flash 3d Game Maker requires the Adobe Flash 10 plugin. <br /><br /><br /><a
                            href="https://get.adobe.com/flashplayer"><img border="0" alt="Enable Flash"
                                src="enable_flash.gif" /></a>
                    </div>
                </div>
            </div>

            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">









            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <div id="footer">

            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
    </div>
    </div>
    <div id="bottomnav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about.php">About</a></li>
            <li><a href="/parents-teachers.php">Parents</a></li>
            <li><a href="/contact.php">Contact Us</a></li>
            <li><a href="/termsofservice.php">Terms of Service</a></li>
            <li><a href="/privacypolicy.php">Privacy Policy</a></li>
            <li><a href="https://discord.gg/E9RmT3TXBa">Discord (Unofficial)</a></li>
        </ul>
    </div>



</body>

</html>