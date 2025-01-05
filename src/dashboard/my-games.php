<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../services/GameListRenderService.php');
require_once('../repositories/repositorymanager.php');
require_once('../content/logincheck.php');
require_once('../database/connect.php');

$db = getDatabase();
$gameRepository = RepositoryManager::get()->getGameRepository();
$gameListRenderService = new GameListRenderService($gameRepository);

$username = $_SESSION['username'];
$totalMetrics = $gameRepository->getTotalMetricsForUser($username);
$currentPage = isset($_GET['o']) ? (int)$_GET['o'] : 0;

if (isset($_GET['game']) && $_GET['game'] == null) {
    unset($_GET['game']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN">
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
            if (confirm(("Are you sure you want to delete " + title)) == true) {
                location.href = ("../php/delete.php?id=" + id);
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
                <li><a href="" class="active">My Games</a></li>
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
            <h3>My Games</h3>
            <p>You've made <?= $totalMetrics->totalGames ?> games, with a total of <?= $totalMetrics->totalViews ?> views so far.
            <form action="my-games.php" method="GET"><label for="title">Search by title: &nbsp;</label><input
                    style="width:98.5%;height:26px" placeholder="My awesome game" value="<?php if (isset($_GET['game'])) {
                                                                                                echo $_GET['game'];
                                                                                         } ?>" class="urlthing"
                    type="text" id="game" name="game" autocomplete="off" autocorrect="off" autocapitalize="off"
                    spellcheck="false" maxlength="100" /><br><br><br></form>
                <?php
                $perPage = 12;
                if (isset($_GET['game'])) {
                    $total = $gameListRenderService->renderPartialViewForMyGamesUserAndGame($username, $_GET['game'], $perPage, $currentPage);
                } else {
                    $total = $gameListRenderService->renderPartialViewForMyGamesUser($username, $perPage, $currentPage);
                }
                ?>
            <?php include('../content/pages.php');
            addPagination($total ?? 0) ?>

            <div class="promo">Lost a game?<br><small><small>If you accidentally deleted a game, we may be able to
                        restore it. You can request to have it restored <a href="trash.php">here</a></small></small>
            </div>
        </div>
        <div id="sidebar">
            <!-- TODO: <h1>GAME BUZZ INCOMPLETE</h1> -->
            <br>
            <br>
            <br>
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../content/footernavigation.php') ?>
</body>
