<?php
require_once('php/verify.php');
require_once('../../services/GameListRenderService.php');
require_once('../../repositories/repositorymanager.php');

$gameListRenderService = new GameListRenderService(RepositoryManager::get()->getGameRepository());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />
    <script>
    function delproj(id, title) {
        if (confirm(("Are you sure you want to delete " + title)) == true) {
            location.href = ("php/delete.php?return=pending.php&url=h://a/a/a.a?id=" + id);
        } else {}
    }
    </script>

    <?php include('../../content/onlinechecker.php'); ?>

</head>
<?php include('../../content/addressbar.php'); ?>

<body id="everyones" class="boosts">
    <?php include('../../content/headernavigation.php'); ?>

    <div id="page">
        <?php include('content/subnav.php'); ?>

        <div id="content" style="width:940px;">
            <?php if (isset($_GET['err'])) : ?>
            <p class="alert"><?= htmlspecialchars($_GET['err']) ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['msg'])) : ?>
            <p class="prompt"><?= htmlspecialchars($_GET['msg']) ?></p>
            <?php endif; ?>

            <h2>Games pending deletion</h2>
            <p>Games that have been inactive for 14 days will be removed from this list.</p>

            <?php
                $gameListRenderService->renderPartialViewForPendingDeletion(14);
            ?>
            <div class="spacer">&nbsp;</div>
        </div>

        <div class="spacer">&nbsp;</div>
        <?php include('../../content/footernavigation.php'); ?>
</body>

</html>
