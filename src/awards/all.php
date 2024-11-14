<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../database/connect.php');
$material_list = array(
	0 => "Pewter",
	1 => "Iron",
	2 => "Alloy",
	3 => "Copper",
	4 => "Bronze",
	5 => "Silver",
	6 => "Gold",
	7 => "Platinum",
);
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
							width: 64px;
							height: 64px;
                            margin-left: 16px;
							margin-top: 16px;
                            /* Scale the layers */
							
                        }

                        .shine {
                            overflow: hidden;
                            
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
            <li><a href="index.php" class="active">Awards</a></li>
            <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
            <li><a href="my-graphics.php">Graphics</a></li>
            <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
			</ul>	
</div><div id="content"><h3>All My Awards</h3>
<?php
$db = connectToDatabase();
// Get total number of awards
$sql = "SELECT COUNT(*) FROM awards WHERE membername = :membername";
$statement = $db->prepare($sql);
$statement->execute([':membername' => $_SESSION['username']]);
$result = $statement->fetchAll();
$total = $result[0][0];
// Get award data
// TODO: LIMIT to 50 and add pagination support to avoid hammering database
// Higher amount of material takes priority
// Higher amount of style takes priority after material
$sql = "SELECT * FROM awards WHERE membername = :membername ORDER BY style DESC, material DESC, color DESC, icon DESC";
$statement = $db->prepare($sql);
$statement->execute([':membername' => $_SESSION['username']]);
$result = $statement->fetchAll();
?>

<h5><big><?= $total ?></big>&nbsp;Award<?= $total == 1 ? '' : 's' ?></h5>
<?php
// Display all awards
foreach($result as $award){
	$award['material_name'] = $material_list[$award['material']];
	$shinestyle = "";
	?>
<div id="" class="award award_64 special_0">
				<div class="layer shine" <?= $shinestyle ?>></div>
				<div class="layer_mini" style="background-image: url('medals/px64/<?= $award['style'].$award['material'].$award['color'].$award['icon'] ?>.gif');"></div>
				<dl class="plaque">
					<dt>Level <?= $award['level'] ?><br/> <?= $award['material_name'].$award['category'] ?>  Award:</dt>
					<dd><?= $award['message'] ?></dd>
					<dd class="award_cite">from <a href="../members/index.php?u=<?= $award['username'] ?>"><?= $award['username'] ?></a></dd>
					
				</dl>
				
			</div>
<?php } ?>
		<div class="spacer">&nbsp;</div></div>
			<div id="sidebar">
           
			    			
			</div>			
			<div class="spacer">&nbsp;</div><?php include('../content/footernavigation.php') ?>
</body>

</html>