<?php

namespace SploderRevival\Repositories;

use SploderRevival\Database\{IDatabase};

require_once(__DIR__ . "/../database/idatabase.php");
require_once(__DIR__ . "/igraphicsrepository.php");

class GraphicsRepository implements IGraphicsRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function replaceTags(int $graphicId, array $tags): void
    {
        $this->db->execute("DELETE FROM graphic_tags WHERE g_id = :id", [
          ':id' => $graphicId
        ]);

        if (!empty($tags)) {
            $values = [];
            $params = [':id' => $graphicId];
            foreach ($tags as $index => $tag) {
                $values[] = "(:id, :tag$index)";
                $params[":tag$index"] = $tag;
            }
            $qs = "INSERT INTO graphic_tags (g_id, tag) VALUES " . implode(", ", $values);
            $this->db->execute($qs, $params);
        }
    }

    public function getUserId(int $graphicId): string
    {
        return $this->db->queryFirstColumn("SELECT userid FROM graphics WHERE id = :id", 0, [
          ':id' => $graphicId
        ]);
    }

    public function getTags($graphicId): array
    {
        return $this->db->query("SELECT tag FROM graphic_tags WHERE g_id = :id", [
          ':id' => $graphicId,
        ]);
    }

    public function trackLike(int $graphicsId, int $loggedInUserId): void
    {
        $userId = $this->db->queryFirstColumn("SELECT userid FROM graphics WHERE id=:id", 0, [
        'id' => $graphicsId
        ]);

        if ($userId !== $loggedInUserId) {
            try {
                $this->db->execute("
INSERT INTO graphic_likes (userid, g_id) VALUES (:userid, :projid)
on conflict do nothing", [
                ':userid' => $loggedInUserId,
                ':projid' => $graphicsId,
                ]);
            } catch (\Exception $ex) {
              // TODO: log this error, as the conflict should handle this
            }
        }
    }
}
