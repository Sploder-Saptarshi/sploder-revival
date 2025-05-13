<?php

namespace SploderRevival\Services;

interface IGameFeedService
{
    public function generateWeirdFeed(array $results): string;

    public function generateFeedForPopularGames(): string;

    public function generateFeedForWeirdPopularGames(): string;

    public function generateFeedForContestWinners(int $contestIdOffset): string;
}
