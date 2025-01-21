<?php

require_once(__DIR__ . "/../database/idatabase.php");
require_once(__DIR__ . "/igamerepository.php");

class GameRepository implements IGameRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    function trackView(int $game_id, string $ip_address, int|null $user_id): void
    {
        $query = "
INSERT INTO game_views_anonymous(g_id, ipaddress) values(:g_id, :ipaddress)
on conflict do nothing;";

        $this->db->execute($query, [
            ':g_id' => $game_id,
            ':ipaddress' => $ip_address,
        ]);

        if ($user_id !== null) {
            $query = "
INSERT INTO game_views_members(g_id, userid) values(:g_id, :userid)
on conflict do nothing;";

            $this->db->execute($query, [
                ':g_id' => $game_id,
                ':userid' => $user_id,
            ]);

            $query = "
UPDATE games
  SET views=(select count(*) from game_views_members gvm where gvm.g_id = :g_id)
where g_id = :g_id
";
            $this->db->execute($query, [
                ':g_id' => $game_id,
            ]);
        }
    }

    public function getGameData(int $gameId): GameData
    {
        $gameInfo = $this->db->queryFirst("SELECT author, difficulty FROM games WHERE g_id = :g_id", [
            ':g_id' => $gameId,
        ]);

        $avgScore = $this->db->queryFirstColumn("SELECT AVG(score) as avg FROM votes WHERE g_id = :g_id", 0, [
            ':g_id' => $gameId,
        ]);

        if ($avgScore === null) {
            $avgScore = 0;
        } else {
            $avgScore = round($avgScore);
        }

        return new GameData($gameInfo['author'], round($gameInfo['difficulty']), $avgScore);
    }

    public function getGameTags(int $perPage, int $offset): GameTags
    {
        $tags = $this->db->query("SELECT DISTINCT tag FROM game_tags ORDER BY tag LIMIT :perpage OFFSET :offset", [
            ':perpage' => $perPage,
            ':offset' => $offset,
        ]);

      // Delete the below line and just get the length of $tags?
        $total = $this->db->queryFirstColumn("SELECT COUNT(DISTINCT tag) as total_unique_tags FROM game_tags");

        return new GameTags($tags, $total);
    }

    public function getUserId(int $gameId): string
    {
        return $this->db->queryFirstColumn("SELECT user_Id FROM games WHERE g_id = :g_id", 0, [
            ':g_id' => $gameId,
        ]);
    }

    public function getRandomGames(): array
    {
        $query = "SELECT g_id, title, author, user_id FROM games WHERE ispublished = 1 AND isprivate = 0 ORDER BY RANDOM() LIMIT 6";
        return $this->db->query($query);
    }

    public function getPendingDeletionGames(): array
    {
        return $this->db->query("SELECT
            games.g_id, games.date, MIN(pending_deletions.timestamp) as deletion_date, g_swf, author, title, userid as user_id, reason, views
            FROM pending_deletions
            JOIN games ON games.g_id = pending_deletions.g_id 
            JOIN members ON games.author = members.username 
            WHERE pending_deletions.timestamp = (SELECT MIN(timestamp) FROM pending_deletions pd WHERE pd.g_id = games.g_id)
            GROUP BY games.g_id, g_swf, author, title, userid, reason, views");
    }

    public function getGamesFromUser(string $userName, int $perPage, int $offset): array
    {
        $qs = "SELECT g.author, g.title, g.description, g.g_id, g.user_id, g.g_swf, g.date, g.user_id, g.views, 
            ROUND(AVG(r.score), 1) as avg_rating, COUNT(r.score) as total_votes 
            FROM games g 
            LEFT JOIN votes r ON g.g_id = r.g_id 
            WHERE g.ispublished = 1 AND g.isprivate = 0 AND g.author = :userName
            GROUP BY g.g_id 
            ORDER BY g.g_id DESC 
            LIMIT :perPage OFFSET :offset";
        return $this->db->query($qs, [
            'userName' => $userName,
            'perPage' => $perPage,
            'offset' => $offset,
        ]);
    }

    public function getGamesByTag($tag, $perPage, $offset): array
    {
        $qs = "SELECT g.author, g.title, g.description, g.g_id, g.user_id, g.g_swf, g.date, g.user_id, g.views, 
            ROUND(AVG(r.score), 1) as avg_rating, COUNT(r.score) as total_votes
            FROM game_tags gt
            JOIN games g on g.g_id = gt.g_id
            LEFT JOIN votes r ON g.g_id = r.g_id
            WHERE gt.tag = :tag
            AND g.ispublished = 1 AND g.isprivate = 0
            GROUP BY g.g_id
            ORDER BY g.g_id DESC
            LIMIT :perPage OFFSET :offset";
        return $this->db->query($qs, [
            'tag' => $tag,
            'perPage' => $perPage,
            'offset' => $offset,
        ]);
    }

    public function getGamesFromUserAndGameSearch(string $userName, string $game, int $perPage, int $offset): array
    {
        $qs = 'SELECT g.author, g.title, g.description, g.g_id, g.user_id, g.g_swf, g.date, g.user_id, g.views, 
            ROUND(AVG(r.score), 1) as avg_rating, COUNT(r.score) as total_votes 
            FROM games g 
            LEFT JOIN votes r ON g.g_id = r.g_id 
            WHERE g.ispublished = 1 AND g.isprivate = 0 AND g.author = :userName
            AND SIMILARITY(title, :game) > 0.3
            GROUP BY g.g_id 
            ORDER BY g.g_id DESC 
            LIMIT :perPage OFFSET :offset';
        return $this->db->query($qs, [
            'userName' => $userName,
            ':game' => $game,
            'perPage' => $perPage,
            'offset' => $offset,
        ]);
    }

    public function getGamesNewest(int $perPage, int $offset): array
    {
        return $this->db->query("SELECT g.g_id, g.author, g.title, g.description, g.user_id, g.g_swf, g.date, g.user_id, g.views, 
            ROUND(AVG(r.score), 1) as avg_rating, COUNT(r.score) as total_votes 
            FROM games g 
            LEFT JOIN votes r ON g.g_id = r.g_id 
            WHERE g.ispublished = 1
            AND g.isprivate = 0
            and g.isdeleted = 0
            GROUP BY g.g_id 
            ORDER BY g.g_id DESC 
            LIMIT :perPage OFFSET :offset", [
            ':offset' => $offset,
            ':perPage' => $perPage
        ]);
    }

    public function removeOldPendingDeletionGames(int $daysOld): void
    {
        // Remove pending deletions older than 14 days
        $this->db->execute("DELETE FROM pending_deletions
            WHERE timestamp < NOW() - MAKE_INTERVAL(DAYS => :daysOld)", [
            ':daysOld' => $daysOld
        ]);
    }

    // TODO: move this to the contest repository
    public function getContestWinners(int $contestId): array
    {
        if ($contestId < 0) {
            return [];
        }

        $query = "SELECT games.g_id, games.title, games.author, games.user_id
		FROM (
			SELECT contest_id, g_id
			FROM contest_winner
			ORDER BY contest_id
			LIMIT 6 OFFSET (:id * 6)
		) AS recent_contests
		JOIN games ON recent_contests.g_id = games.g_id;";
        return $this->db->query($query, ['id' => $contestId]);
    }

    public function getTotalPublishedGameCount(): int
    {
        return $this->db->queryFirstColumn("SELECT COUNT(g_id)
            FROM games
            WHERE ispublished = 1
            AND isprivate = 0", 0);
    }

    public function getTotalMetricsForUser(string $userName): GameMetricsForUser
    {
        $metrics = $this->db->queryFirst("SELECT count(g_id) as totalGames, sum(views) as totalViews
            FROM games
            WHERE author=:user
            AND isdeleted=0", [
            ':user' => $userName,
        ], PDO::FETCH_NUM);
        return new GameMetricsForUser($metrics[0], $metrics[1]);
    }
}
