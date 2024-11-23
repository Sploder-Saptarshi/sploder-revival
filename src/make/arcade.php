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

    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;
    }

    function wheel(e) {
        preventDefault(e);
    }

    function disable_scroll() {
        if (window.addEventListener) {
            window.addEventListener("DOMMouseScroll", wheel, false);
        }
        window.onmousewheel = document.onmousewheel = wheel;
    }

    function enable_scroll() {
        if (window.removeEventListener) {
            window.removeEventListener("DOMMouseScroll", wheel, false);
        }
        window.onmousewheel = document.onmousewheel = null;
    }

    var current_pubkey = "";

    function tryPubMovie(pubkey, size) {
        current_pubkey = pubkey;
        playPubMovie(pubkey, size);
        setClass("launchprompt", "shown");
    }

    function relaunchPubMovie() {
        playPubMovie(current_pubkey, 480);
        setClass("launchprompt", "hidden");
    }

    var flashvars = {
        v: "21",
        pr: "21",
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
        bgcolor: "#2c03a0",
        base: "https://www.sploder.com"
    };

    var attributes = {
        v: "1"
    };

    //disable_scroll();

    swfobject.embedSWF("creator7preloader3.swf?pr=21", "flashcontent", "860", "626", "10.2.152",
        "/swfobject/expressInstall.swf", flashvars, params);
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

<body id="creator" class="arcade">
    <?php include('../content/headernavigation.php'); ?>


    <div id="page">
        <?php include('../content/subnav.php'); ?>

        <div id="content">
            <h3>Retro Arcade Game Maker</h3>
            <div style="border: 1px solid #999; color: #ccc; padding: 6px; margin: 0 19px 10px 19px; font-size: 11px; background: #660066"
                align="center" id="launchprompt" class="hidden">Playing published game. If you are blocking pop-ups,
                click <a href="#" onclick="relaunchPubMovie();">play game now</a>.</div>
            <div id="creatorcontainer" style="width: 860px; height: 626px;">
                <div id="flashcontent">
                    <div style="margin: 40px auto; text-align: center; width: 600px;">

                        <a href="https://itunes.apple.com/us/app/sploder-arcade-creator/id897669842?ls=1&mt=8">
                            <img src="chrome/app_badge_apple.gif" width="203" height="60" /> &nbsp;
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.sploder.arcadecreator">
                            <img src="chrome/app_badge_googleplay.gif" width="170" height="60" /> &nbsp;
                        </a>
                        <a href="https://www.amazon.com/gp/product/B00LWFWFVY/ref=mas_pm_sploder_arcade_creator">
                            <img src="chrome/app_badge_amazon.gif" width="171" height="60" />
                        </a>

                        <br /><br />

                        <img src="images/retro-arcade-game-maker2.gif" width="420" height="260" /><br /><br />


                        <br />

                        <p style="width: 420px; margin: auto;">Make your own 8-bit retro arcade game with this game
                            maker. Build fun platformers, RPG stories, boss-battles, and unique games with this game
                            maker.</p>
                        <p style="width: 420px; margin: auto;">The Flash Arcade Game Maker requires the Adobe Flash
                            plugin.<br /><br /><br />
                        <div align="center" style="margin: auto;"><a href="https://get.adobe.com/flashplayer"><img
                                    border="0" alt="Enable Flash" src="enable_flash.gif" /></a></div>
                        </p>
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
            <div class="adslot" style="width: 728px; height: 90px;">
                <script type="text/javascript">
                <!--
                google_ad_client = "ca-pub-3994856696311428";
                /* 728x90, creator page */
                google_ad_slot = "0844648245";
                google_ad_width = 728;
                google_ad_height = 90;
                //
                -->
                </script>
                <script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            </div>
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




    <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-92552-8']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
            '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
    </script>

</body>

</html>