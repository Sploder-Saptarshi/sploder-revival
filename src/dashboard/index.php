<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../content/logincheck.php');
$username = $_SESSION['username'];
include_once('../database/connect.php');
$db = connectToDatabase('members');
$qs2 = "SELECT level FROM members WHERE username=:user LIMIT 1";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':user' => $username
    ]
);
$result3 = $statement2->fetchAll();
$level = $result3[0]['level']
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php include('../content/head.php'); ?>
	<link href="css/css.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../css/sploder_v2p3.css">
	<link rel="stylesheet" type="text/css"  href="../css/sploder_v2p22.min.css"/>
    <link rel="stylesheet" type="text/css"  href="../slider/nivo-slider.css" />
	<link rel="stylesheet" type="text/css" href="../css/inline_help.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="./css/notifications.css">
	<style media="screen" type="text/css">
	#swfhttpobj {
		visibility: hidden
	}
	</style>
		<?php include('../content/onlinecheck.php'); ?>

</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="" onload="doLoad();">
		  <?php include('../content/headernavigation.php'); ?>
		<div id="page">
		<div id="subnav">
			<ul class="nav_dashboard">
            <li><a href="/" class="active">Home</a></li>
            <li><a href="my-games.php">My Games</a></li>
            <li><a href="profile-edit.php">Profile</a></li>
            <li><a href="/friends/index.php">Friends</a></li>
            <li><a href="groups/">Groups</a></li>
            <li><a href="/awards/index.php">Awards</a></li>
            <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
            <li><a href="my-graphics.php">Graphics</a></li>
            <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
			</ul>	
</div>	  <div id="content">
			<div class="prompt">Welcome, <?php echo $username ?>! What would you like to do?
			</div>
			<div id="new_status" class="dashboard">
			  <div id="idbadge">
				<div>
				  <a href="../accounts/avatar.php">
					<img src="../php/avatarproxy.php?u=<?= $username ?>" alt="Edit Your Avatar" title="Edit Your Avatar" border="0"
					  width="96" height="96">
				  </a>
				  <p class="badgename">
					<a href="https://web.archive.org/web/20140608214730/http://www.sploder.com/games/members/mjduniverse/"
					  title="View profile"><?php echo $username ?></a>
				  </p>
				  <p>
					<a href="../friends/index.php"
					  title="Manage friends">1 friends</a>
				  </p>
				  <p class="note"><abbr
					  >Level
					  <?php echo $level ?></abbr>
					<a class="tooltip">&nbsp;<span><strong>How do I level up?</strong>
						<br>You
						level up by participating in Sploder Revival. Play games and vote on them,
						create your own games, and make friends. As you do this, your level
						will increase. Leveling up will unlock certain items in the creators,
						and allow you to do more on Sploder Revival.
					  </span>
					</a>
				  </p>
				</div>
			  </div>
			  <ul class="actions">
				<li class="wow">
				  <a href="../friends/index.php"><strong>?</strong>
					new friend requests!</a>
				</li>
				<li>
				  <a href="../make/index.php">Make
					your own game</a>
				</li>
				<li>
				  <a href="../accounts/avatar.php">Change your
					avatar</a>
				</li>
				<li>
				  <a href="../friends/index.php">Find friends</a>
				</li>
				<li>
				  <a href="../make/graphics.php">Draw
					some graphics</a>
				</li>
			  </ul>
			</div>
			<div class="spacer">&nbsp;</div>
			<?php include('../content/checkban.php') ?>
			<?php if(checkBan($username)){ ?>
			<div class="promo"><b>NOTICE: </b>Your account access has been limited. A moderator has disallowed you from publishing games, making comments or giving awards.</div>
			<?php } ?>
			<?php include('../content/friendgamelist.php'); ?>
			<?php include('../content/dashboardmessages.php'); ?>
			<br>
			<div class="spacer">&nbsp;</div>
			<?php include('../content/friendactivity.php') ?>
			<br>
			<br>
			<div class="notifications">
			  <h4>
			  </h4>
			</div>
			<br>
			<br style="clear: both;">
			<img src="./index_files/pixie.gif" width="1" height="1">
			<div class="spacer">&nbsp;
			</div>
		  </div>
		  <div id="sidebar">

			<?php include('../content/powercharts.php') ?>
			
			<?php include('../content/onlinelist.php') ?>
			
			
			<br>
			<br>
			<br>
			<div class="spacer">&nbsp;</div>
		  </div>
		  <div class="spacer">&nbsp;</div>
<?php include('../content/footernavigation.php') ?>
</body>

</html>