<?php

namespace SploderRevival\Services;

interface IGameListRenderService
{
    public function renderPartialViewForMostPopularTags(): void;

    public function renderPartialViewForPendingDeletion(int $daysOldToDelete): void;

    public function renderPartialViewForUser(string $userName, int $offset, int $perPage): void;

    public function renderPartialViewForMyGamesUser(string $userName, int $offset, int $perPage, bool $isDeleted): void;

    public function renderPartialViewForMyGamesUserAndGame(string $userName, string $game, int $offset, int $perPage, bool $isDeleted): void;

    public function renderPartialViewForNewestGames(int $offset, int $perPage): void;

    public function renderPartialViewForGamesWithTag(string $tag, int $offset, int $perPage): void;

    public function renderPartialViewForGamesSearch(string $game, int $offset, int $perPage): void;
}
