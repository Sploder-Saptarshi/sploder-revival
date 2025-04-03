<?php

/**
 * Handles database interations with awards
 */
interface IAwardsRepository
{

    function hasAwardBeenSent($fromUserName, $toUserName): bool;

    function insertAward(string $fromUserName,
        string $toUserName,
        string $level,
        string $category,
        string $style,
        string $material,
        string $icon,
        string $color,
        string $message): void ;
}
