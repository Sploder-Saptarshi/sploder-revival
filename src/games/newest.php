<?php
session_start();
require_once('../services/GameListRenderService.php');
require_once('../repositories/repositorymanager.php');

$gameRepository = RepositoryManager::get()->getGameRepository();
$gameListRenderService = new GameListRenderService($gameRepository);
$perPage = 12;
$total = $gameRepository->getTotalPublishedGameCount();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php') ?>
    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />
    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>
    <?php include(__DIR__ . '/../content/onlinechecker.php'); ?>
</head>
<?php include('../content/addressbar.php'); ?>

<body id="everyones" class="featured">

    <?php include('../content/headernavigation.php') ?>
    <div id="page">
        <?php include('../content/subnav.php') ?>


        <div id="content">
            <h3>Everyone's Games</h3>
            <p>This is a list of the newest games Sploder Revival members have created. Play them, have fun, and make
                sure you
                vote for your favorites! To see
                the first games made on Sploder Revival, go to the <a
                    href="?o=<?php echo max(0, floor(($total - 1) / $perPage) * $perPage); ?>">end of
                    the
                    list</a>.
            </p>
            <?php
                $gameListRenderService->renderPartialViewForNewestGames($perPage, $_GET['o'] ?? 0);
            ?>
<?php
                    require('../content/pages.php');
                    addPagination($total ?? 0, $perPage)
?>
            </div>
            <div class="spacer">&nbsp;</div>
        </div>
        <div id="sidebar">
            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../content/footernavigation.php') ?>
</body>

</html>
