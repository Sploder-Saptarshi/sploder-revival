<?php include('php/verify.php'); ?>
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

    <?php include('../../content/onlinecheck.php'); ?>

</head>
<?php include('../../content/addressbar.php'); ?>

<body id="everyones" class="boosts">
    <?php include('../../content/headernavigation.php'); ?>

    <div id="page">
        <?php include('content/subnav.php'); ?>

        <div id="content" style="width:940px;">
            <?php if (isset($_GET['err'])): ?>
            <p class="alert"><?= htmlspecialchars($_GET['err']) ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['msg'])): ?>
            <p class="prompt"><?= htmlspecialchars($_GET['msg']) ?></p>
            <?php endif; ?>

            <h2>Games pending deletion</h2>
            <p>Games that have been inactive for 14 days will be removed from this list.</p>

            <?php
      require_once('content/pending.php');

      ?>
            <?php if (count($games) != 0): ?>
            <div id="viewpage">
                <div style="width:915px;" class="set">
                    <?php foreach ($games as $game): ?>

                    <div class="game">
                        <div class="photo">
                            <a
                                href="/games/play.php?&id=<?= $game['g_id'] ?>&g_swf=<?= $game['g_swf'] ?>&title=<?= $game['title'] ?>&pub=0">
                                <img src="/users/user<?= $game['userid'] ?>/images/proj<?= $game['g_id'] ?>/thumbnail.png"
                                    width="80" height="80" />
                            </a>
                        </div>
                        <p class="gamedate"><?= date('m&\m\i\d\d\o\t;d&\m\i\d\d\o\t;y', strtotime($game['date'])) ?></p>
                        <h4>
                            <a
                                href="/games/play.php?&id=<?= $game['g_id'] ?>&g_swf=<?= $game['g_swf'] ?>&title=<?= $game['title'] ?>&pub=0"><?= urldecode($game['title']) ?></a>
                        </h4>
                        <h5>
                            <a href="../../members/index.php?u=<?= $game['author'] ?>"><?= $game['author'] ?></a>
                        </h5>
                        <p class="gameviews"><?= $game['views'] ?> views</p>
                        <input title="Delete" type="button"
                            onclick="delproj(<?= $game['g_id'] ?>,'<?= urldecode($game['title']) ?>')"
                            style="width:37px" value="Delete">&nbsp;
                        <br><br>
                        <?= nl2br(htmlspecialchars($game['reason'])) ?>
                    </div>

                    <?php endforeach; ?>
                    <div class="spacer">&nbsp;</div>
                </div>


            </div>
            <?php else:
        echo "<p>No games pending deletion</p>";
      endif; ?>

            <div class="spacer">&nbsp;</div>
        </div>

        <div class="spacer">&nbsp;</div>
        <?php include('../../content/footernavigation.php'); ?>
</body>

</html>