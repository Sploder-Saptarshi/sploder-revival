<?php
session_Start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard/index.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('content/head.php'); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/slider/jquery.nivo.slider.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="/slider/nivo-slider.css" />
    <link rel="stylesheet" type="text/css" href="/slider/sploder/style_v2p10.css" />
    <?php include('content/onlinecheck.php'); ?>
</head>
<?php include('content/addressbar.php'); ?>

<body id="home" class="" onload="doLoad();">
    <?php include('content/headernavigation.php'); ?>
    <div id="page">
        <?php include('content/subnav.php'); ?>
        <div id="s-wrapper">

            <div class="slider-wrapper theme-dark" id="slideshow_bkgd">

                <div id="slider" class="nivoSlider">

                    <a href="make/arcade.php"><img src="/images/hp3/hp_retro_arcade_night.gif"
                            data-src="/images/hp3/hp_retro_arcade_night.gif" width="920" height="440" alt=""
                            title="#htmlcaption6" /></a>

                    <a href="make/plat.php "><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_platformer_archers.gif" width="920" height="440" alt=""
                            title="#htmlcaption2" /></a>

                    <a href="make/ppg.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_physics_topple.gif" width="920" height="440" alt=""
                            title="#htmlcaption4" /></a>

                    <a href="make/shooter.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_classic_kaboom.gif" width="920" height="440" alt=""
                            title="#htmlcaption1" /></a>

                    <a href="make/algo.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_3d_tactical_kaboom.gif" width="920" height="440" alt=""
                            title="#htmlcaption3" /></a>

                    <a href="make/arcade.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_retro_arcade_slip.gif" width="920" height="440" alt=""
                            title="#htmlcaption6" /></a>

                    <a href="make/plat.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_platformer_ninjas.gif" width="920" height="440" alt=""
                            title="#htmlcaption2" /></a>

                    <a href="make/ppg.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_physics_splash.gif" width="920" height="440" alt=""
                            title="#htmlcaption4" /></a>

                    <a href="make/shooter.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_classic_episode.gif" width="920" height="440" alt=""
                            title="#htmlcaption1" /></a>

                    <a href="make/algo.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_3d_tactical_heroes.gif" width="920" height="440" alt=""
                            title="#htmlcaption3" /></a>

                    <a href="make/plat.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_platformer_gator.gif" width="920" height="440" alt=""
                            title="#htmlcaption2" /></a>

                    <a href="make/shooter.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_classic_robot_battles.gif" width="920" height="440" alt=""
                            title="#htmlcaption1" /></a>

                    <a href="make/algo.php"><img src="/images/hp3/loading.gif" data-src="/images/hp3/hp_3d_ship.gif"
                            width="920" height="440" alt="" title="#htmlcaption3" /></a>

                    <a href="make/shooter.php"><img src="/images/hp3/loading.gif"
                            data-src="/images/hp3/hp_classic_art.gif" width="920" height="440" alt=""
                            title="#htmlcaption1" /></a>

                </div>





                <div id="htmlcaption6" class="nivo-html-caption" style="overflow: visible;">

                    <h3><a href="make/arcade.php">Retro Arcade Game Maker</a></h3>Make your own 8-bit side-scrolling
                    arcade games with stories and RPG elements.


                </div>


                <div id="htmlcaption4" class="nivo-html-caption">

                    <h3><a href="make/ppg.php">Physics Puzzle Game Maker</a></h3>Build tumbling, toppling physics
                    puzzlers, interactive stories or games with your own <a href="make/graphics.php">graphics</a>.

                </div>



                <div id="htmlcaption3" class="nivo-html-caption">

                    <h3><a href="make/algo.php">3d Sci-fi Action Game Maker</a></h3>Create levels for this intense
                    pseudo-3d action game with stunning graphics.

                </div>



                <div id="htmlcaption2" class="nivo-html-caption">

                    <h3><a href="make/plat.php">Platformer Game Maker</a></h3>Make awesome adventure games with hundreds
                    of unique platforming elements.

                </div>



                <div id="htmlcaption1" class="nivo-html-caption">

                    <h3><a href="make/shooter.php">Classic Space Shooter</a></h3>Make fast-paced space shooting games
                    with intricate geometric level designs.

                </div>

            </div>

        </div>



        <script type="text/javascript">
        var prev_img = null;

        $(window).load(function() {

            var ss_bkgd = $('#slideshow_bkgd');

            $('#slider').nivoSlider({

                pauseOnHover: true,

                pauseTime: 6000,

                afterChange: function() {

                    ss_bkgd.css("background-position", "10px 10px");

                    ss_bkgd.css("background-image", "url(" + $('#slider').data('nivo:vars')
                        .currentImage.data('src') + ")");

                }

            })

        });
        </script>



        <div id="content">
            <?php if ((isset($_GET['msg'])) && ($_GET['msg']) == "out") { ?>
            <div class="prompt">You have been logged out of your account.</div>
            <?php } ?>
            <div class="homebuttons">

                <a href="/free-game-creator.php" class="sprite_button home_button_makegame">Make a game</a>

                <a href="/games/members/" class="sprite_button home_button_members">Members</a>

                <a href="games/newest.php"><img src="/chrome/home_button_newestgames.gif" width="160" height="120"
                        alt="Newest Games" /></a>
            </div>



            <br style="clear: both;" />



            <p>Want to make your own online games for free? <strong>Sploder &trade;</strong> makes it super easy for you
                to make your own free games online. Make your own <a href="make/arcade.php">arcade games</a>, <a
                    href="make/plat.php">platformer games</a>, <a href="make/shooter.php">spaceship shooters</a>, or <a
                    href="/previews/algorithmcrew/">space adventure games</a>. Advanced game maker? Try the <a
                    href="make/ppg.php">physics game maker</a> for creating original minigames! You can even customize
                it with your own game art using our <a href="make/graphics.php">free graphics editor!</a></p>



            <div class="buttons" style="padding: 0;">

                <span class="button firstbutton"><a href="/members/hall-of-fame/">Hall of Fame &raquo;</a></span>&nbsp;

                <span class="button"><a href="games/groups/">Groups &raquo;</a></span>&nbsp;

                <span class="button"><a href="games/epic/">Epic Games &raquo;</a></span>&nbsp;

                <span class="button"><a href="games/reviews/">Reviews &raquo;</a></span>&nbsp;

                <span class="button"><a href="games/tags/">Tags &raquo;</a></span>

            </div>



            <br /><br />


            <?php include('content/mostpopulargames.php'); ?>
            <?php include('content/trendinggames.php'); ?>

            <br style="clear: both;" />




            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">





            <!--<img src="../chrome/bots_side.jpg" width="175" height="210" border="0" alt="Robots!" />-->

            <div class="spacer">&nbsp;</div>

            <br />
            <?php include('content/hotgames.php') ?>
            <div class="newfeatures">



                <h4>Share Your Games with Everyone!</h4>

                <p>You can embed your games on your facebook or myspace profile, your own web site or send a link to
                    your game by email.</p>



                <h4>Play Games and Cast your Vote!</h4>

                <p>You can vote on the games you play, and others can vote on yours. The most popular games are featured
                    here!</p>



            </div>
            <?php include('content/powercharts.php') ?>



            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('content/footernavigation.php'); ?>


</body>

</html>