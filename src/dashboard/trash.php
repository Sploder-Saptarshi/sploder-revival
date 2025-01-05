<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('../content/logincheck.php');
$username = $_SESSION['username'];
require('../database/connect.php');
if (isset($_GET['game']) && $_GET['game'] == null) {
    unset($_GET['game']);
}

$db = getDatabase();
$result4 = $db->query("SELECT g_id FROM games WHERE author=:user AND isdeleted=1", [
    ':user' => $username
]);
$totalgames = count($result4);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/sploder_v2p3.css">
    <link rel="stylesheet" type="text/css" href="../css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="../slider/nivo-slider.css" />
    <link rel="stylesheet" type="text/css" href="../css/inline_help.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="./css/notifications.css">
    <style media="screen" type="text/css">
        #swfhttpobj {
            visibility: hidden
        }
    </style>
    <?php include('../content/onlinechecker.php'); ?>
    <script>
        function delproj(id, title) {
            let text;
            if (confirm(("Are you REALLY REALLY sure you want to delete " + title +
                    "\nRemember, permanently deleted games can NEVER be recovered, not even by the developers.")) == true) {
                location.href = ("../php/permadelete.php?id=" + id);
            } else {}
        }
    </script>
    <script>
        function resproj(id, title) {
            let text;
            if (confirm(("Are you sure you want to restore " + title)) == true) {
                location.href = ("../php/restore.php?id=" + id);
            } else {}
        }
    </script>

</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="" onload="doLoad();">
    <?php include('../content/headernavigation.php'); ?>
    <div id="page">
        <div id="subnav">
            <ul class="nav_dashboard">
                <li><a href="/">Home</a></li>
                <li><a href="my-games.php" class="active">My Games</a></li>
                <li><a href="profile-edit.php">Profile</a></li>
                <li><a href="/friends/index.php">Friends</a></li>
                <!-- TODO: Groups <li><a href="groups/">Groups</a></li> -->
                <li><a href="/awards/index.php">Awards</a></li>
                <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
                <li><a href="my-graphics.php">Graphics</a></li>
                <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
            </ul>
        </div>
        <div id="content">
            <h3>Deleted Games</h3>
            <p>Here's a list of all your deleted games. Remember, permanently deleted games can NEVER be recovered, not
                even by the developers.</p>
            <form action="<?php echo $currentpage ?>" method="GET"><label for="title">Search by title:
                    &nbsp;</label><input style="width:98.5%;height:26px" placeholder="My deleted game" value="<?php if (isset($_GET['game'])) {
                                                                                                                    echo $_GET['game'];
                                                                                                              } ?>"
                    class="urlthing" type="text" id="game" name="game" autocomplete="off" autocorrect="off"
                    autocapitalize="off" spellcheck="false" maxlength="100" /><br><br><br></form>
            <div class="set"><?php if ($totalgames == "0") {
                                    echo "You have not deleted any games so far!";
                             } else {
                                 if (isset($_GET['o'])) {
                                     $o = $_GET['o'];
                                 } else {
                                     $o = "0";
                                 }
                                 $offset = 12;
                                 if (!isset($_GET['game'])) {
                                     $parameters = [
                                         ':username' => $username
                                     ];
                                     $result = $db->query('SELECT * 
                                     FROM games 
                                     WHERE author=:username
                                     AND isdeleted = 1
                                     ORDER BY "g_id" DESC', $parameters);
                                     $total = count($result);

                                     // TODO: put offset as a parameter instead of string concat
                                     $result = $db->query('SELECT *
                                       FROM games
                                       WHERE author=:username
                                       AND isdeleted = 1
                                       ORDER BY "g_id" DESC
                                       LIMIT 12 OFFSET ' . $o . '', $parameters);

                                     $resultTotal = $db->queryFirstColumn("SELECT count(1)
                                       FROM games
                                       WHERE author=:username
                                       AND isdeleted = 1
                                       LIMIT 12 OFFSET " . $o . "", 0, $parameters);
                                 } else {
                                     $parameters = [':username' => $username];
                                     if (isset($_GET['game'])) {
                                         $parameters = $parameters + [':game' => $_GET['game']];
                                     }

                                     $result = $db->query('SELECT *
                                     FROM games
                                     WHERE author=:username
                                     AND isdeleted = 1
                                     AND SIMILARITY(title, :game) > 0.3
                                     ORDER BY "g_id" DESC', $parameters);
                                     $total = count($result);

                                     // TODO: put offset as a parameter instead of string concat
                                     $result = $db->query('SELECT *
                                       FROM games
                                       WHERE author=:username
                                       AND isdeleted = 1
                                       AND SIMILARITY(title, :game) > 0.3
                                       ORDER BY "g_id" DESC
                                       LIMIT 12 OFFSET ' . $o . '', $parameters);

                                     $resultTotal = $db->queryFirstColumn("SELECT count(1)
                                       FROM games
                                       WHERE author=:username
                                       AND isdeleted = 1
                                       AND SIMILARITY(title, :game) > 0.3
                                       LIMIT 12 OFFSET " . $o . "", 0, $parameters);
                                 }


                                 $f = '20';
                                 if (count($result) == "0" && $_GET['game'] != null) {
                                     echo 'This game was not found.<div class="spacer">&nbsp;</div>';
                                 }

                                 // TODO: migrate to GameListRenderService
                                 for ($i = 0; $i < count($result); $i++) {
                                     if ($result[$i]['g_id'] == null) {
                                         break;
                                     };
                                     echo '<div class="game">';
                                     $date = date_parse(substr_replace($result[$i]['date'], "20", 0, 0));
                                     echo '<div class="photo">';
                                     echo '<a href="/play_game.php?&id=' . $result[$i]['g_id'] . '&g_swf=' . $result[$i]['g_swf'] . '&title=' . $result[$i]['title'] . '&pub=0"><img src="/projects/proj' . $result[$i]['g_id'] . '/thumbnail.png" width="80" height="80"/></a>';
                                     echo '</div>';
                                     echo '<p class="gamedate">' . $date['month'] . '&middot;' . $date['day'] . '&middot;' . substr($date['year'], 2) . '</p>';
                                     echo '<h4><a href="/play_game.php?&id=' . $result[$i]['g_id'] . '&g_swf=' . $result[$i]['g_swf'] . '&title=' . $result[$i]['title'] . '&pub=0">' . urldecode($result[$i]['title']) . '</a></h4>';
                                     echo '<input title="Delete" type="button" onclick="delproj(' . $result[$i]['g_id'] . ',\'' . urldecode($result[$i]['title']) . '\')" style="width:37px" value="Delete">&nbsp;<input title="Restore" class="boost_button" type="button" onclick="resproj(' . $result[$i]['g_id'] . ',\'' . urldecode($result[$i]['title']) . '\')" style="width:41px" value="Restore">';
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
            <?php include('../content/pages.php');
            addPagination($total ?? 0) ?>

        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../content/footernavigation.php') ?>
</body>

</html>
