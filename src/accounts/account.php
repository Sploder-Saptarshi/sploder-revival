<?php include('../content/logincheck.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="splodersimple.css" />


    <?php include('../content/onlinecheck.php'); ?>


    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>





</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="">

    <div id="main">
        <div id="header">
            <a href="/">
                <div id="title">
                    <h1><a href="/" title="Sploder"><img style="margin-top:-20px; height: 130px"
                                src="/chrome/logo.png"><span class="hide">Games at Sploder</span></a></h1>
                </div>
                <div id="tools"></div>
            </a>
        </div>
        <div id="page">
            <div id="content">
                <div id="new_status" class="get_started">

                    <h4>Hi there <?php echo $_SESSION['username'] ?>! Let's get started&hellip;</h4>
                    <ul class="actions">
                        <li>
                            <a href="/accounts/avatar.php">Edit your Avatar</a>
                            <p>Customize your avatar on Sploder Revival here!</p>
                        </li>
                        <li>
                            <a href="/make/index.php">Make your own game</a>
                            <p>Make your own games for your friends to play.</p>
                        </li>
                        <li>
                            <a href="/">Proceed to your dashboard</a>
                            <p>When logged in, the Sploder Revival home page will display your dashboard.</p>
                        </li>
                        <li>
                            <a href="/friends/index.php">Find friends</a>
                            <p>Already know people on Sploder? Search for them here.</p>
                        </li>
                        <li>
                            <a href="/games/featured.php">Play some games</a>
                            <p>Start playing and rating other people's games.</p>
                        </li>
                    </ul>

                </div>

                <!--{LATESTGAMES}--><br style="clear: both;" />
            </div>
        </div>
    </div>
    <div id="bottomnav">
        <ul>
            <li><a href="/legal/termsofservice.php">Terms of Service</a></li>
            <li><a href="/credits.php">Credits</a></li>
            <li><a href="/legal/privacypolicy.php">Privacy Policy</a></li>
        </ul>
    </div>




</body>

</html>