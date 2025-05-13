<?php

namespace SploderRevival\Repositories;

use SploderRevival\Database\{IDatabase};

require_once(__DIR__ . "/../database/idatabase.php");
require_once(__DIR__ . "/iuserrepository.php");

class UserRepository implements IUserRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function search(string $userName, int $limit = 180)
    {
        $qs = "
SELECT
    username,
    SIMILARITY(username, :u) AS sim,
    level
FROM members
WHERE SIMILARITY(username, :u) > 0.3 
ORDER BY sim 
DESC LIMIT :limit";
        return $this->db->query($qs, [
        ':u' => trim($userName ?? ''),
        ':limit' => $limit,
        ]);
    }

    public function getTopMembers()
    {
        $qs = "
        WITH latest_view AS (
    SELECT MAX(create_date) AS max_time
    FROM (
        SELECT MAX(create_date) AS create_date FROM public.game_views_members
        UNION ALL
        SELECT MAX(create_date) FROM public.game_views_anonymous
    ) AS combined_views
)
SELECT 
    g.author, 
    COUNT(gv.g_id) + COUNT(ga.g_id) AS total_views, 
    (SELECT max_time FROM latest_view) AS last_view_time
FROM public.games g
LEFT JOIN public.game_views_members gv 
    ON g.g_id = gv.g_id 
    AND gv.create_date >= (SELECT max_time FROM latest_view) - INTERVAL '24 hours'
LEFT JOIN public.game_views_anonymous ga 
    ON g.g_id = ga.g_id 
    AND ga.create_date >= (SELECT max_time FROM latest_view) - INTERVAL '24 hours'
GROUP BY g.author
ORDER BY total_views DESC
LIMIT 90;
";
        return $this->db->query($qs);
    }

    private function getLevel(int $rating, int $friends, int $games, int $views)
    {
        $level = min(250, floor($rating / 25 + $friends / 10 + $games / 10 + $views / 1000) + 1);
        return $level;
    }

    public function getMembers(int $offset)
    {
        $offset = $offset * 100;
        $qs = "
        SELECT 
            m.username,
            m.joindate,
            COUNT(DISTINCT f.user2) AS friend_count,
            COUNT(DISTINCT g.g_id) FILTER (WHERE g.ispublished = 1 AND g.isprivate = 0 AND g.isdeleted = 0) AS game_count,
            COALESCE(SUM(g.views), 0) AS total_views,
            (SELECT COUNT(*) FROM votes v2 WHERE v2.username = m.username) AS total_ratings_given
        FROM 
            members m
        LEFT JOIN 
            friends f ON m.username = f.user1
        LEFT JOIN 
            games g ON m.username = g.author
        GROUP BY 
            m.username, m.joindate
        ORDER BY 
            m.joindate
        LIMIT 100 OFFSET :offset
    ";
        $result = $this->db->query($qs, [':offset' => $offset]);
        foreach ($result as &$row) {
            $row['level'] = $this->getLevel(
                $row['total_ratings_given'],
                $row['friend_count'],
                $row['game_count'],
                $row['total_views']
            );
        }
        return $result;
    }

    public function getTotalNumberOfMembers(): int
    {
        $qs = "SELECT COUNT(*) FROM members";
        return $this->db->query($qs)[0]['count'];
    }

    public function getLevelByUserId(int $userId)
    {
        $qs = "
            SELECT 
                (SELECT COUNT(*) FROM votes v WHERE v.username = m.username) AS total_ratings_given,
                COUNT(DISTINCT f.user2) AS friend_count,
                COUNT(DISTINCT g.g_id) AS game_count,
                COALESCE(SUM(g.views), 0) AS total_views
            FROM 
                members m
            LEFT JOIN 
                friends f ON m.username = f.user1
            LEFT JOIN 
                games g ON m.username = g.author
            WHERE 
                m.userid = :id
            GROUP BY 
                m.username
        ";

        $result = $this->db->queryFirst($qs, [':id' => $userId]) ?? null;

        if ($result) {
            return $this->getLevel(
                $result['total_ratings_given'],
                $result['friend_count'],
                $result['game_count'],
                $result['total_views']
            );
        }

        return null; // Return null if no user found
    }

    public function saveEvent(string $s, string $e, string $g)
    {
        $filePath = __DIR__ . '/../cache/events.xml';
        $lockFilePath = __DIR__ . '/../cache/events.lock';

        $lockFile = fopen($lockFilePath, 'w');
        if (flock($lockFile, LOCK_EX)) {
            try {
                $eventsXml = '<root>';
                if (file_exists($filePath) && filesize($filePath) > 0) {
                    $rawData = file_get_contents($filePath);
                    if (trim($rawData) !== '') {
                        $eventsXml .= $rawData;
                    }
                }
                $eventsXml .= '</root>';

                // Load XML with a temporary root
                $events = simplexml_load_string($eventsXml);

                // Add new event
                $event = $events->addChild('evt');
                $event->addAttribute('u', $_SESSION['username']);
                $event->addAttribute('e', $e);
                $event->addAttribute('g', $g);
                $event->addAttribute('s', $s);
                $event->addAttribute('d', time());

                // Keep only the last 16 entries
                $children = $events->children();
                while (count($children) > 16) {
                    unset($children[0]);
                }

                // Remove the root and save back in original format
                $newXml = '';
                foreach ($events->evt as $evt) {
                    $newXml .= $evt->asXML() . "\n";
                }

                file_put_contents($filePath, $newXml, LOCK_EX);
            } catch (\Exception $ex) {
                error_log('Error saving event: ' . $ex->getMessage());
            } finally {
                flock($lockFile, LOCK_UN);
                fclose($lockFile);
            }
        }
    }
}
