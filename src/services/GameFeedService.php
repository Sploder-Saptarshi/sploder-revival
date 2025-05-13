<?php

namespace SploderRevival\Services;

use SploderRevival\Repositories\{IGameRepository};

class GameFeedService extends IGameFeedService
{
    private readonly IGameRepository $gameRepository;

    public function __construct(IGameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    private function getCurrentDateTime(): string
    {
        return date('D, d M Y H:i:s e', time());
    }

    private function getCurrentYear(): string
    {
        return date('Y');
    }

    private function generateFeed(string $title, string $description, array $results): string
    {
        header("Content-Type: application/rss+xml; charset=utf-8");

        $rssFeed = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
        $rssFeed .= "<rss version=\"2.0\">\n";
        $rssFeed .= "<channel>\n";
        $rssFeed .= "<title>{$title}</title>\n";
        $rssFeed .= "<description>{$description}</description>\n";
        $rssFeed .= "<language>en-us</language>\n";
        $rssFeed .= "<copyright>{$this->getCurrentYear()}, Sploder.net</copyright>\n";
        $rssFeed .= "<lastBuildDate>{$this->getCurrentDateTime()}</lastBuildDate>\n";

        foreach ($results as $row) {
            $rssFeed .= "<item>\n";
            $rssFeed .= "   <title>{$row['title']}</title>\n";
            $rssFeed .= "   <link>/games/play.php?s={$row['user_id']}_{$row['g_id']}</link>\n";
            $rssFeed .= "   <description><img src=\"/users/user{$row['user_id']}/images/proj{$row['g_id']}/thumbnail.png\" alt=\"{$row['author']}\" /></description>\n";
            $rssFeed .= "   <guid>/games/play.php?s={$row['user_id']}_{$row['g_id']}</guid>\n";
            $rssFeed .= "</item>\n";
        }

        $rssFeed .= "</channel>\n";
        $rssFeed .= "</rss>";
        return $rssFeed;
    }

    public function generateWeirdFeed(array $results): string
    {
        header("Content-Type: application/xml; charset=utf-8");

        $xml = new \SimpleXMLElement('<games/>');

        foreach ($results as $row) {
            $item = $xml->addChild('item');
            $item->addAttribute('name', $row['title']);
            $item->addAttribute('author', $row['author']);
            $item->addAttribute('thumb', "/users/user{$row['user_id']}/images/proj{$row['g_id']}/thumbnail.png");
            $item->addAttribute('link', "../../../../../../games/play.php?s={$row['user_id']}_{$row['g_id']}");
        }

        return $xml->asXML();
    }
    public function generateFeedForPopularGames(): string
    {
        return $this->generateFeed(
            "Sploder Revival, Popular Games",
            "The most popular games on Sploder Revival.",
            $this->gameRepository->getRandomGames()
        );
    }

    public function generateFeedForWeirdPopularGames(): string
    {
        return $this->generateWeirdFeed($this->gameRepository->getWeirdRandomGames());
    }

    public function generateFeedForContestWinners(int $contestIdOffset): string
    {
        return $this->generateFeed(
            "Sploder Revival, Contest Winners",
            "The winners for the latest Sploder Revival contest.",
            $this->gameRepository->getContestWinners($contestIdOffset)
        );
    }
}
