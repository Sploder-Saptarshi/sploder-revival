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

    swfobject.embedSWF("creator5_b22.swf", "flashcontent", "860", "600", "10.2", "/swfobject/expressInstall.swf",
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

<body id="creator" class="physics">

    <div id="main">
        <div id="header">
            <div id="title">
                <h1><a href="/" title="Sploder Make Your Own Games"><span class="hide">Physics Puzzle Game
                            Maker</span></a></h1>
            </div>
            <div id="tools">
                <ul>

                    <li id="parentslink">

                        <a href="/parents-teachers.php">Parents &amp; Teachers</a>&nbsp; |

                    </li>

                    <li>

                        <a href="/accounts/login/" id="loginlink">Log in</a>

                    </li>

                    <li id="signup">

                        |&nbsp; <a href="/accounts/register/">Sign up</a>

                    </li>

                </ul>
            </div>
            <ul id="topnav">
                <li id="nav1"><a href="/games/featured/">Play Games</a></li>
                <li id="nav2"><a href="/free-game-creator.php">Make a Game</a></li>
                <li id="nav3"><a href="/games/challenges/">Challenges</a></li>
                <li id="nav4"><a href="/games/members/">Members</a></li>
                <li id="nav5"><a href="/games/contest/">Contest</a></li>
            </ul>
        </div>

        <div class="adslot" style="width: 970px; height: 90px;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Sploder Home Page Top Banner -->
            <ins class="adsbygoogle" style="display:inline-block;width:970px;height:90px"
                data-ad-client="ca-pub-3994856696311428" data-ad-slot="8550546099"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <div id="page">
            <div id="subnav">

                <ul class="nav_games">
                    <li><a href="/">Home</a></li>
                    <li><a href="/games/featured/">Featured</a></li>
                    <li><a href="/games/boosts/">Boosts</a></li>
                    <li><a href="/games/">Newest</a></li>
                    <li><a href="/games/reviews/">Reviews</a></li>
                    <li><a href="/games/tournaments/">Tournaments</a></li>
                    <li><a href="/graphics/">Graphics</a></li>
                    <li><a href="/games/favorites/">Favorites</a></li>
                    <li><a href="/games/web/">Web</a></li>
                    <li><a href="/games/tags/">Tags</a></li>
                    <li><a href="/games/epic/">The EGL</a></li>
                    <li><a href="/games/search/">Search</a></li>
                </ul>
                <ul class="nav_members">
                    <li><a href="/">Home</a></li>
                    <li><a href="/members/all/">Member List</a></li>
                    <li><a href="/games/groups/">Groups</a></li>
                    <li><a href="/members/staff/">Staff</a></li>
                    <li><a href="/members/contest/">Member of the Day</a></li>
                    <li><a href="/members/hall-of-fame/">Hall of Fame</a></li>
                    <li><a href="/messages/">Latest Comments</a></li>
                </ul>
                <ul class="nav_creators">
                    <li><a href="/">Home</a></li>
                    <li><a href="/free-arcade-game-maker.php">Arcade Creator</a></li>
                    <li><a href="/free-platformer-game-maker.php">Platformer Creator</a></li>
                    <li><a href="/free-physics-puzzle-game-maker.php">Physics Creator</a></li>
                    <li><a href="/free-graphics-editor.php">Graphics Editor</a></li>
                    <li><a href="/free-shooter-game-maker.php">Classic Creator</a></li>
                    <li><a href="/free-3d-game-maker.php">3d Adventure Creator</a></li>
                </ul>
            </div>

            <div id="content">
                <h3>Physics Puzzle Game Maker</h3>
                <div id="creatorcontainer" style="height: 600px; width: 860px">
                    <div id="flashcontent">
                        <div style="margin: 40px auto; text-align: center; width: 420px;">
                            <img src="images/physics-puzzle-maker.png" width="348" height="172" /><br /><br /><br />
                            <p>Make your own physics puzzle game with this game maker. Build machines, robots, Rube
                                Goldberg devices, and unique games with this game maker.</p>
                            <p>The Flash Physics Puzzle Game Maker requires the Adobe Flash plugin.<br /><br /><br />
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