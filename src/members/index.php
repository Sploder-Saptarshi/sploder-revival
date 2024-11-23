<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../database/connect.php');
$username = $_GET['u'];
$currentpage = "index.php";

function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second'
	);

	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$db = connectToDatabase();

$publicgames = " AND isdeleted=0 AND ispublished=1 AND isprivate=0";

// Fetch friends
$friendsStmt = $db->prepare("SELECT id FROM friends WHERE user1 = :username");
$friendsStmt->execute([':username' => $username]);
$friends = $friendsStmt->fetchAll();

// Fetch total games
$totalGamesStmt = $db->prepare("SELECT g_id FROM games WHERE author = :username $publicgames");
$totalGamesStmt->execute([':username' => $username]);
$totalgames = $totalGamesStmt->rowCount();

// Fetch user details
$userDetailsStmt = $db->prepare("SELECT userid, level, perms, joindate, lastlogin FROM members WHERE username = :username");
$userDetailsStmt->execute([':username' => $username]);
$result = $userDetailsStmt->fetchAll();
$exists = isset($result[0]['userid']) ? 1 : 0;
$user_id = $exists ? $result[0]['userid'] : null;

// Fetch total plays
$playsStmt = $db->prepare("SELECT COUNT(1) FROM leaderboard WHERE pubkey IN (SELECT g_id FROM games WHERE author = :username $publicgames)");
$playsStmt->execute([':username' => $username]);
$plays = $playsStmt->fetchColumn();

// Fetch total playtime
$playtimeStmt = $db->prepare("SELECT SUM(gtm) FROM leaderboard WHERE pubkey IN (SELECT g_id FROM games WHERE author = :username $publicgames)");
$playtimeStmt->execute([':username' => $username]);
$playtime = gmdate("i:s", round($playtimeStmt->fetchColumn() / max(1, $plays)));

// Fetch total votes
$votesStmt = $db->prepare("SELECT COUNT(1) FROM votes WHERE g_id IN (SELECT g_id FROM games WHERE author = :username $publicgames)");
$votesStmt->execute([':username' => $username]);
$votes = $votesStmt->fetchColumn();

// Fetch average difficulty
$difficultyStmt = $db->prepare("SELECT AVG(difficulty) FROM games WHERE author = :username $publicgames");
$difficultyStmt->execute([':username' => $username]);
$difficulty = min(100, round($difficultyStmt->fetchColumn() * 10));

//Get feedback in percentage by calculating average vote of games (0-5)
if ($result[0]['lastlogin'] > (time() - 30)) {
	$result[0]['lastlogin'] = time();
}
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
							$result[0]['perms'] = $result[0]['perms'] ?? '';
							$roles = [
								'E' => 'editor',
								'R' => 'reviewer',
								'M' => 'moderator'
							];

							foreach ($roles as $key => $role) {
								$icon = str_contains($result[0]['perms'], $key) ? "role_$role" : "role_empty";
								echo "<img src=\"/chrome/{$icon}.gif\" width=\"24\" height=\"28\" alt=\"$role\" title=\"$role\" />";
							}
							?>
                        </div>
                        <dl>
                            <dt><strong>Level</strong></dt>
                            <dd><strong><?php echo $result[0]['level'] ?></strong></dd>
                            <dt>Joined:</dt>
                            <dd><?php echo time_elapsed_string("@" . $result[0]['joindate']) ?></dd>
                            <dt>Last visit:</dt>
                            <dd>
                                <?php
								$lastLoginTime = $result[0]['lastlogin'];
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
            <div id="viewpage">
                <div class="set"><?php
									if ($totalgames == "0") {
									?>
                    <p class="prompt">No games found!</p>
                    <div class="spacer">&nbsp;</div>
                    <?php

									} else {
										$o = isset($_GET['o']) ? $_GET['o'] : "0";
										$offset = 12;

										$queryString = 'SELECT * FROM games WHERE author=:username ' . $publicgames . ' ORDER BY "g_id" DESC';
										if (isset($_GET['game'])) {
											$queryString = 'SELECT * FROM games WHERE author=:username ' . $publicgames . ' AND SIMILARITY(title, :game) > 0.3 ORDER BY "g_id" DESC';
										}

										$statement = $db->prepare($queryString);
										$statement->execute([':username' => $username] + (isset($_GET['game']) ? [':game' => $_GET['game']] : []));

										$result = $statement->fetchAll();
										$total = count($result);

										$queryString = $queryString . ' LIMIT 12 OFFSET ' . $o;
										$statement = $db->prepare($queryString);
										$statement->execute([':username' => $username] + (isset($_GET['game']) ? [':game' => $_GET['game']] : []));

										$result = $statement->fetchAll();
										$qTotal = "SELECT count(1) FROM games WHERE author=:username " . $publicgames . (isset($_GET['game']) ? ' AND SIMILARITY(title, :game) > 0.3' : '') . ' LIMIT 12 OFFSET ' . $o;
										$staTotal = $db->prepare($qTotal);
										$staTotal->execute([':username' => $username] + (isset($_GET['game']) ? [':game' => $_GET['game']] : []));

										$resultTotal = $staTotal->fetchAll();
										$resultTotal = $resultTotal[0][0];

										$f = '20';
										if (count($result) == "0") {
											echo 'This game was not found.<div class="spacer">&nbsp;</div>';
										}
										for ($i = 0; $i < count($result); $i++) {
											if ($result[$i]['g_id'] == null) {
												break;
											};
											echo '<div class="game">';

											echo '<div class="photo">';
											echo '<a href="/games/play.php?&id=' . $result[$i]['g_id'] . '&g_swf=' . $result[$i]['g_swf'] . '&title=' . $result[$i]['title'] . '&pub=0"><img src="/users/user' . $user_id . '/images/proj' . $result[$i]['g_id'] . '/thumbnail.png" width="80" height="80"/></a>';
											echo '</div>';
						?>
                    <p class="gamedate"><?= date('m&\m\i\d\d\o\t;d&\m\i\d\d\o\t;y', strtotime($result[$i]['date'])) ?>
                    </p>
                    <?php
											echo '<h4><a href="/games/play.php?&id=' . $result[$i]['g_id'] . '&g_swf=' . $result[$i]['g_swf'] . '&title=' . $result[$i]['title'] . '&pub=0">' . urldecode($result[$i]['title']) . '</a></h4>';
											echo '<p class="gamevote"><img src="/chrome/rating0.gif" width="64" height="12" border="0" alt="0 stars"/> 0 votes</p><p class="gameviews">' . $result[$i]['views'] . ' views</p>';
											echo '<div class="spacer">&nbsp;</div>';
											echo '</div>';
										}

										/*for ($i = 0; $i < count($result); $i++) {
				echo '<div class="game"><div class="photo"><a href="../games/playgame.php?id=916&g_swf=7&title=Martie Echito  A Taste Of Americana&pub=0"><img src="/projects/proj916/thumbnail.png" width="80" height="80"/></a></div><p class="gamedate">6&middot;1&middot;23</p><h4><a href="/play_game.php?id=916&g_swf=7&title=Martie Echito  A Taste Of Americana&pub=0&p=0">Martie Echito  A Taste Of Americana</a></h4><input title="Delete" style="width:30px" value="Delete">&nbsp;<input title="Boost" style="width:25px" class="boost_button" value="Boost">&nbsp;<input title="Challenge" style="width:45px" class="challenge_button" value="Challenge"><div class="spacer">&nbsp;</div></div>';
			}*/
									}

					?>
                    <div class="spacer">&nbsp;</div>
                </div>
                <?php if (isset($total)) {
					include('../content/pages.php');
				} ?>



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