<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../database/connect.php');
include_once('php/materials.php');
?>
<?php include('../content/logincheck.php');
require_once('php/functions.php');
$level = getLevel();
if($level < 10) {
    header("Location: ../index.php");
    die();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php include('../content/head.php'); ?>
	<link href="css/css.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css"  href="../css/sploder_v2p22.min.css"/>
    <link rel="stylesheet" type="text/css"  href="css/friends2.css"/>
	<link rel="stylesheet" type="text/css"  href="css/awards.css"/>
	<style media="screen" type="text/css">
	#swfhttpobj {
		visibility: hidden
	}
	</style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
	
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime();</script>
	
	
	<link href="/css/members.css" rel="stylesheet" type="text/css" />
	<style>
                        #layers_mini {
                            position: relative;
                            /* Ensure the container is positioned relatively */
                            height: 192px;
                            /* Set a height for the container */
                        }

                        .layer_mini {
                            position: absolute;
                            /* Position the layers absolutely within the container */
                            top: 0;
                            left: 0;
							background-color: transparent; /* Ensure the background color is transparent */
							width: 32px;
							height: 32px;
                            margin-left: 32px;
							margin-top: 32px;
                            /* Scale the layers */
							
                        }

                        .shine {
                            overflow: hidden;
                            transform: scale(0.625);
                            width: 96px;
                            height: 96px;
                            background-image: url('chrome/award_shine_96.gif');

                    }
                    .award_text {
                        margin-top: -35px;
                        margin-left: 60px;
						display: flex;
                    }
					.award_text dt div {
        display: inline; /* Ensure nested div is inline */
    }

                    .award_text dl {
                        margin: 0;
                        padding: 0;

                    }
					div.award_option span {
						display: block;
    position: absolute;
    right: 10px;
    top: 10px;
    text-align: right;
    color: #666;
					}
					div.award_option a {
						
    position: relative;
    color: #999;
    font-weight: normal; 
	z-index:1;
    
}
					
                </style>
		<?php include('../content/onlinecheck.php'); ?>
</head>
<?php include('../content/addressbar.php'); ?>

<body id="friendsmanager" class="friend"  onload="doLoad();">
	  <?php include('../content/headernavigation.php'); ?>
		<div id="page">
        <div id="subnav">
			<ul class="nav_dashboard">
            <li><a href="/">Home</a></li>
            <li><a href="../dashboard/my-games.php">My Games</a></li>
            <li><a href="../dashboard/profile-edit.php">Profile</a></li>
            <li><a href="../friends/index.php">Friends</a></li>
            <li><a href="groups/">Groups</a></li>
            <li><a href="" class="active">Awards</a></li>
            <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
            <li><a href="my-graphics.php">Graphics</a></li>
            <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
			</ul>	
</div><div id="content"><h3>Manage My Awards</h3>
<?php if(isset($_GET['err'])){
$err = $_GET['err'];
if($err=="you"){ ?>
<div class="alert">You cannot award yourself!</div>
<?php }
elseif($err=="no"){ ?>
<div class="alert">That user does not exist!</div>
<?php }
elseif($err=="sent"){ ?>
<div class="alert">You have already sent an award request to that user!</div>
<?php } elseif($err=="suc"){ ?>
<div class="prompt">Award sent successfully!</div>
<?php } elseif($err=="level"){ ?>
<div class="alert">That user is already your friend!</div>
<?php } elseif($err=="before"){ ?>
<div class="alert">That user revoked the award before you could accept it!</div>
<?php }


} ?>
<h4>Pending Awards To You</h4>
<?php
$db = connectToDatabase();
$sql = "SELECT * FROM award_requests WHERE membername = :username ORDER BY id DESC";
$statement = $db->prepare($sql);
$statement->execute([':username' => $_SESSION['username']]);
$pendingawards = $statement->fetchAll();


?>

<?php if(count($pendingawards)==0){ ?>
	<p>You don't have any pending awards</p>
<?php } else { 

	foreach($pendingawards as $award) {
	$membername = $award['username'];
	$level = $award['level'];
	$category = $award['category'];
	
	if ($category == "") {
		$category = " ";
	} else {
		$category = " ".$category." ";
	}
	$style = $award['style'];
	$material = $award['material'];
	$icon = $award['icon'];
	$color = $award['color'];
	if($style == 7 || $material == 7 || $icon == 7 || $color == 7){
		$shinestyle = "";
	} else {
		$shinestyle = "style=\"display: none;\"";
	}
	$message = htmlspecialchars($award['message']);
	$awardid = $award['id'];
?>
<div class="award">
<div class="award_option"><span><a href="php/decline.php?id=<?= $awardid ?>">Decline</a> | <a href="php/accept.php?id=<?= $awardid ?>">Accept</a></span></div>
                <div id="avatar" style="overflow: hidden; height: 48px">
                    

                    <div id="layers_mini" style="overflow: hidden; margin-top:-22px; margin-left: -22px">
                        <div class="layer shine" <?= $shinestyle ?>></div>
                        <div class="layer_mini" style="background-image: url('medals/px32/<?= $style.$material.$color.$icon ?>.gif');"></div>
                    </div>
                </div>
				
                <div class="award_text">
                    <dl>
						<div style="display: inline;"><dt id="messageTitle">Level <?= $level ?> <?=$material_list[$material] ?><?=$category?>Award from&nbsp;<div style="font-weight: normal;"><a style="display:inline-block; position:absolute" href="../members?u=<?= $membername ?>"><?= $membername ?></a></div></dt></div>
                        <dd id="messageDisplay" style="margin-inline-start: 0px;"><?= $message ?></dd>
                    </dl>
                </div>
</div>
<?php } ?>

<?php } 
// Check whether user has at least 1 award
$sql = "SELECT COUNT(*) FROM awards WHERE membername = :username LIMIT 1";
$statement = $db->prepare($sql);
$statement->execute([':username' => $_SESSION['username']]);
$result = $statement->fetchAll();
if ($result[0][0] > 0) {
?>

<br><span style="float:right" class="button"><a href="all.php">View all my awards</a></span><br><br>
<?php
}
$sql = "SELECT * FROM award_requests WHERE username = :username ORDER BY id DESC";
$statement = $db->prepare($sql);
$statement->execute([':username' => $_SESSION['username']]);
$pendingawards = $statement->fetchAll();


?>
<?php if(count($pendingawards)!=0){ ?>
<h4>Pending Awards made by You</h4>


<!-- START AWARD REQUESTS -->
<?php

foreach($pendingawards as $award) {
	$membername = $award['membername'];
	$level = $award['level'];
	$category = $award['category'];
	
	if ($category == "") {
		$category = " ";
	} else {
		$category = " ".$category." ";
	}
	$style = $award['style'];
	$material = $award['material'];
	$icon = $award['icon'];
	$color = $award['color'];
	if($style == 7 || $material == 7 || $icon == 7 || $color == 7){
		$shinestyle = "";
	} else {
		$shinestyle = "style=\"display: none;\"";
	}
	$message = htmlspecialchars($award['message']);
	$awardid = $award['id'];
?>
<div class="award">
<div class="award_option"><span><a href="php/revoke.php?id=<?= $awardid ?>">Revoke</a></span></div>
                <div id="avatar" style="overflow: hidden; height: 48px">
                    

                    <div id="layers_mini" style="overflow: hidden; margin-top:-22px; margin-left: -22px">
                        <div class="layer shine" <?= $shinestyle ?>></div>
                        <div class="layer_mini" style="background-image: url('medals/px32/<?= $style.$material.$color.$icon ?>.gif');"></div>
                    </div>
                </div>
				
                <div class="award_text">
                    <dl>
						<div style="display: inline;"><dt id="messageTitle">Level <?= $level ?> <?=$material_list[$material] ?><?=$category?>Award to&nbsp;<div style="font-weight: normal;"><a style="display:inline-block; position:absolute" href="../members?u=<?= $membername ?>"><?= $membername ?></a></div></dt></div>
                        <dd id="messageDisplay" style="margin-inline-start: 0px;"><?= $message ?></dd>
                    </dl>
                </div>
</div>

<?php } ?>
				<!-- END AWARD REQUESTS -->

<?php } ?>
<?php
$maxAwards = maxAward($level);
?>


<h4>Make an Award</h4>
<?php if ($maxAwards > 0): ?>
	<p>You can make <?= $maxAwards ?> more award<?= $maxAwards == 1 ? '' : 's' ?> today.</p>
<?php else: ?>
	<p>You cannot make any more awards today.</p>
<?php endif; ?>

<?php if ($maxAwards > 0): ?>
<div class="friend_chooser">

<h4>Find a member to make an award for:</h4>

<form action="creator.php" method="GET">
<label for="friendname">Enter a member's username:</label>
<input type="text" id="friendname" name="membername" required autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="16"/>
<input style="width:50px;text-align:left;padding-left:5px" type="submit" name="submit" class="postbutton" value="Make"/>
</form>
</div>
<?php endif; ?>

		<div class="spacer">&nbsp;</div></div>
			<div id="sidebar">
            <script type="text/javascript">
			    window.onload = function () {
				var n;
				n = document.createElement('link');
				n.rel = 'stylesheet';
				n.type = 'text/css';
				n.href = '../css/venue5.css';
				document.getElementsByTagName('head')[0].appendChild(n);
				n = document.createElement('script');
				n.type = 'text/javascript';
				document.getElementsByTagName('head')[0].appendChild(n);
				if (onload2) onload2();
			  }
			</script>
            <?php include('../content/onlinelist.php') ?>
			    			
			</div>			
			<div class="spacer">&nbsp;</div><?php include('../content/footernavigation.php') ?>
</body>

</html>