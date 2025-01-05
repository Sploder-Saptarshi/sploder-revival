<?php
require_once('content/index.php');
require_once('../repositories/repositorymanager.php');
require_once('../services/GameListRenderService.php');

$gameListRenderService = new GameListRenderService(RepositoryManager::get()->getGameRepository());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/member_profile3.css" />

    <?php include('../content/onlinecheck.php'); ?>
</head>
<?php include('../content/addressbar.php'); ?>

<body id="members" class="">
    <?php include('../content/headernavigation.php'); ?>
    <div id="page">
        <?php include('../content/subnav.php'); ?>
        <div id="content">
            <h3></h3>
            <div class="mprof">
                <div class="mprofgroup mprofvcard">
                    <a href="/members/index.php?u=<?php echo $username ?>"><img class="mprofavatar96"
                            src="../php/avatarproxy.php?u=<?php echo $username ?>" width="96" height="96"
                            alt="mat7772" /></a>
                    <div class="mprofvitals">
                        <h2><a href="/members/index.php?u=<?php echo $username ?>"><?php echo $username ?></a></h2>
                        <div class="mprofstatus">
                            <img src="../php/userstatus.php?u=<?php echo $username ?>" width="80" height="25"
                                alt="online status" />
                            <?php
                            $result['perms'] = $result['perms'] ?? '';
                            $roles = [
                                'E' => 'editor',
                                'R' => 'reviewer',
                                'M' => 'moderator'
                            ];

                            foreach ($roles as $key => $role) {
                                $icon = strpos($result['perms'], $key) !== false ? "role_$role" : "role_empty";
                                echo "<img src=\"/chrome/{$icon}.gif\" width=\"24\" height=\"28\" alt=\"$role\" title=\"$role\" />";
                            }
                            ?>
                        </div>
                        <dl>
                            <dt><strong>Level</strong></dt>
                            <dd><strong><?php echo $result['level'] ?></strong></dd>
                            <dt>Joined:</dt>
                            <dd><?php echo time_elapsed_string("@" . $result['joindate']) ?></dd>
                            <dt>Last visit:</dt>
                            <dd>
                                <?php
                                $lastLoginTime = $result['lastlogin'];
                                // 30 second buffer
                                echo (time() - $lastLoginTime < 30) ? 'just now' : time_elapsed_string("@" . $lastLoginTime);
                                ?>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="shown">
                    <div class="mprofgroup">
                        <div class="mprofchart mprofmain" title="Awesomeness - computed using a secret recipe">
                            <img src="/images/charts/awesomeness/chart_50.png" width="230" height="116" />
                            <p>Awesomeness</p>
                        </div>
                        <div class="mprofcount" title="total games/featured games">
                            <div class="stat"><?php echo $totalgames ?> <span>Games</span></div>
                        </div>
                        <div class="mprofcount mprofend">
                            <div class="stat"><?php echo count($friends) ?> <span>Friends</span></div>
                        </div>

                        <div class="mprofchart" title="Average difficulty, all games combined">
                            <img src="/images/charts/difficulty/chart_<?= $difficulty ?>.png" width="160" height="70" />
                            <p>Difficulty</p>
                        </div>
                        <div class="mprofchart mprofend" title="Average votes, from all players">
                            <img src="/images/charts/feedback/chart_50.png" width="160" height="70" />
                            <p>Feedback</p>
                            <br>
                        </div>
                        <div class="mprofstat mprofmain" title="Total views for all games combined">
                            <div class="stat"><?= $plays ?></div>
                            <p>Total Plays</p>
                        </div>
                        <div class="mprofstat" title="Average play time per game play">
                            <div class="stat"><?= $playtime ?></div>
                            <p>Play Time</p>
                        </div>
                        <div class="mprofstat mprofend" title="Total Votes Received from other players">
                            <div class="stat"><?= $votes ?></div>
                            <p>Total Votes</p>
                        </div>
                        <div class="spacer">&nbsp;</div>
                    </div>
                    <?php include('../content/userinfo.php');
                    display_user_info($username);
                    ?>



                </div>
            </div>
            <h4 class="mprofgames">Games by <?php echo $username ?></h4>
                <?php
                    $gameListRenderService->renderPartialViewForUser($username, 12, $_GET['o'] ?? 0);
                ?>
                <?php
                include('../content/pages.php');
                addPagination($total ?? 0);
                ?>



                <!-- SWFHTTPRequest - for browsers that don't support CORS -->

                <!--
            <div id="communicator" style="position: fixed; top: 1px; left: 1px;">
                <div id="swfhttpobj"></div>
                <script type="text/javascript">
                       swfobject.embedSWF('https://sploder.us/swfhttprequest.swf', 'swfhttpobj', '1', '1', '9', '/swfobject/expressInstall.swf', null, { allowScriptAccess: 'always', bgcolor: '#000000' });
                </script>
            </div>
            -->

                <!-- End SWFHTTPRequest -->


                <script type="text/javascript">
                    us_config = {
                        container: 'messages',
                        venue: 'games/members/mat7772/',
                        venue_container: 'venue',
                        venue_type: 'member',
                        owner: 'mat7772',
                        username: '',
                        ip_address: '162.158.51.177',
                        timestamp: '1696951113',
                        auth: '',
                        use_avatar: true,
                        venue_anchor_link: true,
                        show_messages: true,
                        last_login: '1696864713'
                    }

                    window.onload = function() {
                        return;
                        var n;
                        n = document.createElement('link');
                        n.rel = 'stylesheet';
                        n.type = 'text/css';
                        n.href = 'https://sploder.us/css/venue5.css';
                        document.getElementsByTagName('head')[0].appendChild(n);
                        n = document.createElement('script');
                        n.type = 'text/javascript';
                        n.src = 'https://sploder.us/venue7.js';
                        document.getElementsByTagName('head')[0].appendChild(n);
                        if (window.addthis) addthis.button('#btn1', addthis_ui_config, addthis_share_config);
                    }
                </script>

                <a id="messages_top"></a>
                <div id="messages"></div>
                <div class="spacer">&nbsp;</div>

                <div class="spacer">&nbsp;</div>
            </div>
            <div class="spacer friends_spacer">&nbsp;</div>
            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">




            <div class="motd_widget motd_winner">
                <p>Member of the Day: Coming soon!</p>
                <div class="spacer">&nbsp;</div>
            </div>



            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../content/footernavigation.php') ?>
</body>

</html>
