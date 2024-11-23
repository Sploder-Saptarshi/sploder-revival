<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include('../content/logincheck.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/friends2.css" />
    <style media="screen" type="text/css">
    #swfhttpobj {
        visibility: hidden
    }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>


    <link href="/css/members.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="Javascript">
    </script>
    <?php include('../content/onlinecheck.php'); ?>
</head>
<?php include('../content/addressbar.php'); ?>

<body id="friendsmanager" class="friend" onload="doLoad();">
    <?php include('../content/headernavigation.php'); ?>
    <div id="page">
        <div id="subnav">
            <ul class="nav_dashboard">
                <li><a href="/">Home</a></li>
                <li><a href="../dashboard/my-games.php">My Games</a></li>
                <li><a href="../dashboard/profile-edit.php">Profile</a></li>
                <li><a href="" class="active">Friends</a></li>
                <li><a href="groups/">Groups</a></li>
                <li><a href="/awards/index.php">Awards</a></li>
                <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
                <li><a href="my-graphics.php">Graphics</a></li>
                <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
            </ul>
        </div>
        <div id="content">
            <h3>Manage My Friends</h3>
            <?php if (isset($_GET['err'])) {
				$err = $_GET['err'];
				if ($err == "you") { ?>
            <div class="alert">You cannot friend yourself!</div>
            <?php } elseif ($err == "no") { ?>
            <div class="alert">That user does not exist!</div>
            <?php } elseif ($err == "sent") { ?>
            <div class="alert">You/That user have already sent a friend request to that user/you!</div>
            <?php } elseif ($err == "suc") { ?>
            <div class="prompt">Friend request sent successfully!</div>
            <?php } elseif ($err == "that") { ?>
            <div class="alert">That user is already your friend!</div>
            <?php } elseif ($err == "before") { ?>
            <div class="alert">That user revoked the request before you could accept it!</div>
            <?php }
			} ?>
            <h4>New Friend Requests</h4>
            <?php
			include_once('../database/connect.php');
			$db = connectToDatabase('friend_requests');
			$qs = "SELECT sender_username FROM friend_requests WHERE receiver_id=:sender_id ORDER BY request_id DESC";
			$state = $db->prepare($qs);
			$state->execute(
				[
					':sender_id' => $_SESSION['userid']
				]
			);
			$result = $state->fetchAll();
			for ($i = 0; $i < count($result); $i++) {
				if (file_exists('../avatar/a/' . $result[$i]['sender_username'] . '.png')) {
					$avt = $result[$i]['sender_username'];
				} else {
					$avt = 'fb/noob';
				}
				echo '<div class="friend_request_new friend_request"><img src="../avatar/a/' . $avt . '.png">' . $result[$i]['sender_username'] . ' has requested to add you as a friend.<span style="width:200px"><a href="php/ignore.php?u=' . $result[$i]['sender_username'] . '">ignore</a> | <a href="php/accept.php?u=' . $result[$i]['sender_username'] . '">accept</a></span></div>';
			}
			if (count($result) == 0) {
				echo '<div style="text-align:center" class="friend_request">You have no pending friend requests!</div>';
			}
			?>
            <h4>Sent Requests</h4>
            <?php
			$qs = "SELECT receiver_username FROM friend_requests WHERE sender_id=:sender_id ORDER BY request_id DESC";
			$state = $db->prepare($qs);
			$state->execute(
				[
					':sender_id' => $_SESSION['userid']
				]
			);
			$result = $state->fetchAll();
			for ($i = 0; $i < count($result); $i++) {
				if (file_exists('../avatar/a/' . $result[$i]['receiver_username'] . '.png')) {
					$avt = $result[$i]['receiver_username'];
				} else {
					$avt = 'fb/noob';
				}
				echo '<div class="friend_request"><img src="../avatar/a/' . $avt . '.png">You\'ve requested to become friends with ' . $result[$i]['receiver_username'] . '.<span><a href="php/revoke.php?u=' . $result[$i]['receiver_username'] . '">revoke</a></span></div>';
			}
			if (count($result) == 0) {
				echo '<div style="text-align:center" class="friend_request">You have not sent any request!</div>';
			}
			?><h4>Send a Request</h4>
            <div class="friend_chooser">

                <h4>Send friend request</h4>
                <form action="php/request.php" method="GET">
                    <label for="friendname">Enter your friend's username:</label>
                    <input type="text" id="friendname" name="username" required autocomplete="off" autocorrect="off"
                        autocapitalize="off" spellcheck="false" maxlength="16" />
                    <input style="width:50px;text-align:left;padding-left:5px" type="submit" name="submit"
                        class="postbutton" value="Send" />
                </form>
            </div>
            <?php
			$db = connectToDatabase('friends');
			$qs1 = "SELECT user1,user2 FROM friends WHERE (bested=true) AND (user1=:sender_id) ORDER BY id DESC LIMIT 30";
			$state1 = $db->prepare($qs1);
			$state1->execute(
				[
					':sender_id' => $_SESSION['username']
				]
			);
			$bestedfriends = $state1->fetchAll();
			$newLimit = 30 - count($bestedfriends);


			$qs = "SELECT user1,user2 FROM friends WHERE (bested = false) AND (user1=:sender_id) ORDER BY id DESC LIMIT $newLimit";
			$state = $db->prepare($qs);
			$state->execute(
				[
					':sender_id' => $_SESSION['username']
				]
			);
			$acceptedfriends = $state->fetchAll();

			if ((count($acceptedfriends) + count($bestedfriends)) != 0) {
				echo '<h4>Recent Friends</h4><div id="friends">';
			}
			for ($i = 0; $i < count($bestedfriends); $i++) {
				if ($bestedfriends[$i]['user1'] == $_SESSION['username']) {
					$friendusername = $bestedfriends[$i]['user2'];
				} else {
					$friendusername = $bestedfriends[$i]['user1'];
				}
				if (file_exists('../avatar/a/' . $friendusername . '.png')) {
					$avt = $friendusername;
				} else {
					$avt = 'fb/noob';
				}
			?>
            <div style="margin-left:7px;height:90px" class="friend friend_48 friend_48_best">
                <a class="name" href="../members/index.php?u=<?php echo $friendusername ?>"><img
                        src="../avatar/a/<?php echo $avt ?>.png" width="48" height="48" /></a>
                <a class="name"
                    href="../members/index.php?u=<?php echo $friendusername ?>"><?php echo $friendusername ?></a>
                <span><a style="color:#666"
                        href="php/unbest.php?u=<?php echo $friendusername ?>">Unbest</a></span><span><a
                        style="color:#666" href="php/unfriend.php?u=<?php echo $friendusername ?>">Unfriend</a></span>
            </div>

            <?php
			}
			for ($i = 0; $i < count($acceptedfriends); $i++) {
				if ($acceptedfriends[$i]['user1'] == $_SESSION['username']) {
					$friendusername = $acceptedfriends[$i]['user2'];
				} else {
					$friendusername = $acceptedfriends[$i]['user1'];
				}
				if (file_exists('../avatar/a/' . $friendusername . '.png')) {
					$avt = $friendusername;
				} else {
					$avt = 'fb/noob';
				}
			?>
            <div style="margin-left:7px;height:90px" class="friend friend_48">
                <a class="name" href="../members/index.php?u=<?php echo $friendusername ?>"><img
                        src="../avatar/a/<?php echo $avt ?>.png" width="48" height="48" /></a>
                <a class="name"
                    href="../members/index.php?u=<?php echo $friendusername ?>"><?php echo $friendusername ?></a>
                <span><a style="color:#666" href="php/best.php?u=<?php echo $friendusername ?>">Best</a></span><span><a
                        style="color:#666" href="php/unfriend.php?u=<?php echo $friendusername ?>">Unfriend</a></span>
            </div>

            <?php
			}

			if ((count($acceptedfriends) + count($bestedfriends)) != 0) {
				echo "<div class='spacer'></div></div>";
			}

			?>



            <div class="spacer">&nbsp;</div>

            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">
            <script type="text/javascript">
            window.onload = function() {
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