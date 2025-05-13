<?php

namespace SploderRevival\Services;

use SploderRevival\Repositories\{IGameRepository};

require_once(__DIR__ . '/../content/pages.php');

class GameListRenderService extends IGameListRenderService
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
        bool $includeUsername,
        bool $fixSidebar
    ): void {
        if (count($games) <= 0) {
            echo "<p>$noGamesFoundMessage</p>";
            echo $fixSidebar ? '<div>' : '';
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
                                href="/games/play.php?&s=<?= $userId ?>_<?= $id ?>">
                                <img src="/users/user<?= $userId ?>/images/proj<?= $id ?>/thumbnail.png"
                                    width="80" height="80" />
                            </a>
                        </div>
                        <div class="game-details">
                            <p class="gamedate"><?= $gameDate ?></p>
                            <h4>
                                <a
                                    href="/games/play.php?&s=<?= $userId ?>_<?= $id ?>"><?= urldecode($title) ?>
                                </a>
                            </h4>
                            <?php if ($includeUsername) { ?>
                                <h5>
                                    <a href="../../members/index.php?u=<?= $author ?>"><?= $author ?></a>
                                </h5>
                            <?php } ?>
                            <?php
                            if ($includeTotalVotes) {
                                ?>
                            <p class="gamevote">
                                <img src="<?= $starUrl ?>" width="64" height="12" border="0" alt="'<?= $avgRating ?>' stars"/>
                                <?= $totalVotes ?> vote<?= ($totalVotes == 1 ? '' : 's') ?>
                            </p>
                            <?php } ?>
                            <p class="gameviews"><?= $views ?> view<?= ($views == 1) ? '' : 's' ?></p>
                            <?php if ($anyModification) { ?>
                                <div class="game-buttons">
                                    <?php if ($includeDelete) { ?>
                                        <input title="Delete" type="button"
                                            onclick="delproj(<?= $id ?>,'<?= urldecode($title) ?>')"
                                            style="width:37px" value="Delete">&nbsp;
                                    <?php } ?>
                                    <?php if ($includeBoost) { ?>
                                        <input title="Boost" style="width:27px" class="boost_button" value="Boost">
                                    <?php } ?>
                                    <?php if ($includeChallenge) { ?>
                                        <?php if ($includeBoost) {
                                            echo '&nbsp;';
                                        } ?>
                                        <input title="Challenge" style="width:46px" class="challenge_button" value="Challenge">
                                    <?php } ?>

                                
                                </div>
                            <?php } ?>
                            <div class="spacer">&nbsp;</div>
                            <?php if ($reason !== null) {
                                echo nl2br(htmlspecialchars($reason));
                            }?>
                        </div>
                    </div>
                        <?= ($counter % 2 == 1) ? '<div class="spacer">&nbsp;</div>' : "" ?>
                    <?php endforeach; ?>
                    <div class="spacer">&nbsp;</div>
                </div>
            <?= $fixSidebar ? '' : '</div>' ?>
            <div class="spacer">&nbsp;</div>
        <?php
    }

    public function renderPartialViewForMostPopularTags(): void
    {
        require_once(__DIR__ . '/../content/taglister.php');
        echo '<div class="tagbox"><p class="tags"><strong>Most Popular Tags: </strong>';
        echo displayTags($this->gameRepository->getGameTags(0, 25)->data, true);
        echo '<p>Learn more about <a href="/games/tags.php">tags</a>.</p>';
        echo '</p></div>';
    }

    public function renderPartialViewForPendingDeletion(int $daysOldToDelete): void
    {
        $this->gameRepository->removeOldPendingDeletionGames($daysOldToDelete);
        $games = $this->gameRepository->getPendingDeletionGames();
        $this->renderPartialViewForGames(
            $games,
            "No games pending deletion",
            includeStyleWidth: true,
            includeDelete: true,
            includeBoost: false,
            includeChallenge: false,
            includeUsername: true,
            fixSidebar: false
        );
    }

    public function renderPartialViewForUser(string $userName, int $offset, int $perPage): void
    {
        $games = $this->gameRepository->getPublicGamesFromUser($userName, $offset, $perPage);
        $this->renderPartialViewForGames(
            $games->data,
            "No games found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false,
            includeUsername: false,
            fixSidebar: true
        );
        addPagination($games->totalCount, $perPage, $offset);
    }

    public function renderPartialViewForMyGamesUser(string $userName, int $offset, int $perPage, bool $isDeleted): void
    {
        $games = $this->gameRepository->getAllGamesFromUser($userName, $offset, $perPage);
        $this->renderPartialViewForGames(
            $games->data,
            'You have not made any games yet.<div class="spacer">&nbsp;</div>',
            includeStyleWidth: false,
            includeDelete: true,
            // Boost/Challenge do not currently work, re-enable after implementation
            includeBoost: false,
            includeChallenge: false,
            includeUsername: false,
            fixSidebar: false
        );
        addPagination($games->totalCount, $perPage, $offset);
    }

    public function renderPartialViewForMyGamesUserAndGame(string $userName, string $game, int $offset, int $perPage, bool $isDeleted): void
    {
        $games = $this->gameRepository->getGamesFromUserAndGameSearch($userName, $game, $offset, $perPage, $isDeleted);
        $this->renderPartialViewForGames(
            $games->data,
            'This game was not found.<div class="spacer">&nbsp;</div>',
            includeStyleWidth: false,
            includeDelete: true,
            // Boost/Challenge do not currently work, re-enable after implementation
            includeBoost: false,
            includeChallenge: false,
            includeUsername: false,
            fixSidebar: false
        );
        addPagination($games->totalCount, $perPage, $offset);
    }

    public function renderPartialViewForNewestGames(int $offset, int $perPage): void
    {
        $games = $this->gameRepository->getGamesNewest($offset, $perPage);
        $this->renderPartialViewForGames(
            $games->data,
            "No games found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false,
            includeUsername: true,
            fixSidebar: false
        );
        addPagination($games->totalCount, $perPage, $offset);
        $this->renderPartialViewForMostPopularTags();
    }
    public function renderPartialViewForGamesWithTag(string $tag, int $offset, int $perPage): void
    {
        $games = $this->gameRepository->getGamesWithTag($tag, $offset, $perPage);
        $this->renderPartialViewForGames(
            $games->data,
            "No games found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false,
            includeUsername: true,
            fixSidebar: true
        );
        addPagination($games->totalCount, $perPage, $offset);
        $this->renderPartialViewForMostPopularTags();
    }

    public function renderPartialViewForGamesSearch(string $game, int $offset, int $perPage): void
    {
        $games = $this->gameRepository->getGamesNewestByName($game, $offset, $perPage);
        $this->renderPartialViewForGames(
            $games->data,
            "No games found!",
            includeStyleWidth: false,
            includeDelete: false,
            includeBoost: false,
            includeChallenge: false,
            includeUsername: true,
            fixSidebar: false
        );
        addPagination($games->totalCount, $perPage, $offset);
    }
}
