<?php

namespace SploderRevival\Repositories;

use SploderRevival\Database\{PaginationData};

require_once(__DIR__ . "/../database/PaginationData.php");

/**
 * Handles database interations with games
 */
interface IGameRepository
{
  /**
   * Inserts a view for a specified game
   *
   * @param $gameId the game to track the view
   * @param $ipAddress the ip address assosciated with the user playing the game
   * @param $userId the logged in user who is playing the game, if applicable
   */
    public function trackView(int $gameId, string $ipAddress, int|null $userId): void;

  /**
   * Returns creator userid of a given game
   */
    public function getUserId(int $gameId): string;


  /**
   * Retrieves game data for playing a game
   *
   * @param $gameId
   * @return game data associated with the game
   */
    public function getGameData(int $gameId): GameData;

    /**
     * Retrieves tags for a given game
     *
     * @param $perPage
     * @param $offset
     * @return tags associated with the game
     */
    public function getGameTags(int $offset, int $perPage): PaginationData;

    /**
     * Retrieves random games from the database
     * @return random games
     */
    public function getRandomGames(): array;
    public function getWeirdRandomGames(): array;

    /**
     * Retrieves games that are pending deletion
     * @return games pending deletion
     */
    public function getPendingDeletionGames(): array;

    /**
     * Retrieves games for a given member
     *
     * @param $userId
     * @param $perPage
     * @param $offset
     * @param $isDeleted
     * @return games
     */
    public function getPublicGamesFromUser(string $userName, int $offset, int $perPage): PaginationData;

    public function getAllGamesFromUser(string $userName, int $offset, int $perPage): PaginationData;

    /**
     * Retrieves games for a given member based on a search parameter
     *
     * @param $userId
     * @param $perPage
     * @param $offset
     * @param $isDeleted
     * @return games
     */
    public function getGamesFromUserAndGameSearch(string $userName, string $game, int $offset, int $perPage, bool $isDeleted): PaginationData;

    /**
     * Retrieves the latest games
     *
     * @param $perPage
     * @param $offset
     * @return games
     */
    public function getGamesNewest(int $offset, int $perPage): PaginationData;

    /**
     * Retrieves the latest games with a search term
     *
     * @param $perPage
     * @param $offset
     * @return games
     */
    public function getGamesNewestByName(string $game, int $offset, int $perPage): PaginationData;

    /**
     * Retrieves the games with a specified tag
     *
     * @param $perPage
     * @param $offset
     * @return games
     */
    public function getGamesWithTag(string $tag, int $offset, int $perPage): PaginationData;

    /**
     * Retrieves the tags for a given game
     *
     * @param $perPage
     * @param $offset
     * @return games
     */
    public function getTagsFromGame(int $gameId): array;

    /**
     * Retrieves the contest winners from the database
     * @return contest winners
     */
    public function getContestWinners(int $contestId): array;

    /**
     * Retrieves games that are pending deletion
     * @param $daysOld if exceeds this many days, will delete them
     */
    public function removeOldPendingDeletionGames(int $daysOld): void;

    /**
     * Retrieves the total count of published games
     */
    public function getTotalPublishedGameCount(): int;

    /**
     * Retrieves the total count of published games
     */
    public function getTotalDeletedGameCount($userName): int;

    /**
     * Retrieves the total count of published games for a suer
     */
    public function getTotalMetricsForUser(string $userName): GameMetricsForUser;
}

class GameMetricsForUser
{
    public readonly int $totalViews;
    public readonly int $totalGames;

    public function __construct(int $totalViews, int $totalGames)
    {
        $this->totalViews = $totalViews;
        $this->totalGames = $totalGames;
    }
}

class GameData
{
    public readonly string $author;
    public readonly string $difficulty;
    public readonly float $avgScore;

    public function __construct(string $author, string $difficulty, float $avgScore)
    {
        $this->author = $author;
        $this->difficulty = $difficulty;
        $this->avgScore = $avgScore;
    }
}
