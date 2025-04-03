<?php

require_once(__DIR__ . "/../database/idatabase.php");
require_once(__DIR__ . "/iawardsrepository.php");

class AwardsRepository implements IAwardsRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    private function hasAwardRequestBeenSent($fromUserName, $toUserName): bool
    {
        return $this->db->queryFirstColumn("SELECT count(*) 
            FROM award_requests
            WHERE username = :username
            AND membername = :membername", 0, [
                ':username' => $fromUserName,
                ':membername' => $toUserName]) > 0;
    }

    public function insertAwardRequest(string $fromUserName,
        string $toUserName,
        string $level,
        string $category,
        string $style,
        string $material,
        string $icon,
        string $color,
        string $message): void
    {
        $this->db->execute("INSERT INTO award_requests
            (username, membername, level, category, style, material, icon, color, message)
            VALUES (:username, :membername, :level, :category, :style, :material, :icon, :color, :message)", [
            ':username' => $fromUserName,
            ':membername' => $toUserName,
            ':level' => $level,
            ':category' => $category,
            ':style' => $style,
            ':material' => $material,
            ':icon' => $icon,
            ':color' => $color,
            ':message' => $message
        ]);
    }
}
