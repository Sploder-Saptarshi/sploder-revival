<?php

class GameListRenderService
{
    private readonly IGameRepository $gameRepository;

    public function __construct(IGameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    private function renderPartialViewForGames(
        array $games,
        string $noGamesFoundMessage,
        bool $includeStyleWidth,
        bool $includeDelete,
        bool $includeBoost,
        bool $includeChallenge,
    ): void {
        if (count($games) <= 0) {
            echo "<p>$noGamesFoundMessage</p>";
            return;
        }
        $anyModification = $includeDelete || $includeBoost || $includeChallenge;
        $counter = -1;
        ?>
            <div id="viewpage">
            <div <?= ($includeStyleWidth == true) ? 'style="width:915px;"' : '' ?> class="set">
                    <?php foreach ($games as $game) :
                        $counter = $counter + 1;
                        $id = $game['g_id'];
                        $reason = $game['reason'] ?? null;
                        $swf = $game['g_swf'];
                        $title = $game['title'];
                        $userId = $game['user_id'];
                        $author = $game['author'];
                        $date = $game['date'];
                        $views = $game['views'];
                        $gameDate = date('m&\m\i\d\d\o\t;d&\m\i\d\d\o\t;y', strtotime($date));
                        $avgRating = $game['avg_rating'] ?? 0;
                        $starUrl = "/chrome/rating" . ($avgRating * 10) . ".gif";
                        $includeTotalVotes = isset($game['total_votes']);
                        $totalVotes = $game['total_votes'] ?? 0;
                        ?>
                    <div class="game">
                        <div class="photo">
                            <a
                                href="/games/play.php?&id=<?= $id ?>&g_swf=<?= $swf ?>&title=<?= $title ?>&pub=0">
                                <img src="/users/user<?= $userId ?>/images/proj<?= $id ?>/thumbnail.png"
                                    width="80" height="80" />
                            </a>
                        </div>
                        <p class="gamedate"><?= $gameDate ?></p>
                        <h4>
                            <a
                                href="/games/play.php?&id=<?= $id ?>&g_swf=<?= $swf ?>&title=<?= $title ?>&pub=0"><?= urldecode($title) ?>
                            </a>
                        </h4>
                        <h5>
                            <a href="../../members/index.php?u=<?= $author ?>"><?= $author ?></a>
                        </h5>
                        <p class="gamevote">
                            <img src="<?= $starUrl ?>" width="64" height="12" border="0" alt="'<?= $avgRating ?>' stars"/>
                            <?= $includeTotalVotes ?> vote<?= ($totalVotes == 1 ? '' : '') ?>
                        <p class="gameviews"><?= $views ?> view <?= ($views == 1) ? 's' : '' ?></p>
                        <?= $anyModification ? '<div class="spacer">&nbsp;</div>' : '' ?>
                        <?php if ($includeDelete) {
                            ?>
                        <input title="Delete" type="button"
                            onclick="delproj(<?= $id ?>,'<?= urldecode($title) ?>')"
                            style="width:37px" value="Delete">&nbsp;
                            <?php
                        }
                        ?>
                        <?php
                        if ($includeBoost) {
                            echo '<input title="Boost" style="width:27px" class="boost_button" value="Boost">';
                        }
                        if ($includeChallenge) {
                            if ($includeBoost) {
                                echo '&nbsp;';
                            }
                            echo '<input title="Challenge" style="width:46px" class="challenge_button" value="Challenge">';
                        }
                        ?>

                        <div class="spacer">&nbsp;</div>
                        <?php if ($reason !== null) {
                            nl2br(htmlspecialchars($reason));
                        }?>
                    </div>
                        <?= ($counter % 2 == 1) ? '<div class="spacer">&nbsp;</div>' : "" ?>
                    <?php endforeach; ?>
                    <div class="spacer">&nbsp;</div>
                </div>
            </div>
            <div class="spacer">&nbsp;</div>
        <?php
    }

    public function renderPartialViewForPendingDeletion(int $daysOldToDelete): int
    {
        $this->gameRepository->removeOldPendingDeletionGames($daysOldToDelete);
        $games = $this->gameRepository->getPendingDeletionGames();
        $this->renderPartialViewForGames(
            $games,
            "No games pending deletion",
            includeStyleWidth: true,
            includeDelete: true,
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }

    public function renderPartialViewForUser(string $userName, int $perPage, int $offset): int
    {
        $games = $this->gameRepository->getGamesFromUser($userName, $perPage, $offset);
        $this->renderPartialViewForGames(
            $games,
            "No games found!",
            includeStyleWidth: true,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }

    public function renderPartialViewForTaggedGames(string $tag, int $perPage, int $offset): int
    {
        $games = $this->gameRepository->getGamesByTag($tag, $perPage, $offset);
        $this->renderPartialViewForGames(
            $games,
            "No games with this tag found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }

    public function renderPartialViewForMyGamesUser(string $userName, int $perPage, int $offset): int
    {
        $games = $this->gameRepository->getGamesFromUser($userName, $perPage, $offset);
        $this->renderPartialViewForGames(
            $games,
            'You have not made any games yet.<div class="spacer">&nbsp;</div>',
            includeStyleWidth: false,
            includeDelete: true,
            // Boost/Challenge do not currently work, re-enable after implementation
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }

    public function renderPartialViewForMyGamesUserAndGame(string $userName, string $game, int $perPage, int $offset): int
    {
        $games = $this->gameRepository->getGamesFromUserAndGameSearch($userName, $game, $perPage, $offset);
        $this->renderPartialViewForGames(
            $games,
            'This game was not found.<div class="spacer">&nbsp;</div>',
            includeStyleWidth: false,
            includeDelete: true,
            // Boost/Challenge do not currently work, re-enable after implementation
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }

    public function renderPartialViewForNewestGames(int $perPage, int $offset): int
    {
        $games = $this->gameRepository->getGamesNewest($perPage, $offset);
        $this->renderPartialViewForGames(
            $games,
            "No games found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false
        );
        return count($games);
    }
}
