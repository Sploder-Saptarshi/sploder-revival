<?php

namespace SploderRevival\Repositories;

use GraphicsRepository;
use IAwardsRepository;
use IContestRepository;
use IFriendsRepository;
use IGameRepository;
use IUserRepository;
use SploderRevival\Database\{IDatabase,DatabaseManager};

// This is the main file necessary to import to access the repositories
require_once(__DIR__ . "/irepositorymanager.php");

// Require the database manager to inject the IDatabase
require_once(__DIR__ . "/../database/databasemanager.php");

// Require the implementation of the repos
require_once(__DIR__ . "/gamerepository.php");
require_once(__DIR__ . "/graphicsrepository.php");
require_once(__DIR__ . "/userrepository.php");
require_once(__DIR__ . "/awardsrepository.php");
require_once(__DIR__ . "/userrepository.php");
require_once(__DIR__ . "/contestrepository.php");
require_once(__DIR__ . "/friendsrepository.php");

/**
 * @deprecated Use container for resolution
 */
class RepositoryManager implements IRepositoryManager
{
    private readonly IAwardsRepository $awardsRepository;
    private readonly IContestRepository $contestRepository;
    private readonly IGameRepository $gameRepository;
    private readonly IGraphicsRepository $graphicsRepository;
    private readonly IUserRepository $userRepository;
    private readonly IFriendsRepository $friendsRepository;

    public function __construct(
        IAwardsRepository $awardsRepository,
        IContestRepository $contestRepository,
        IGameRepository $gameRepository,
        IGraphicsRepository $graphicsRepository,
        IUserRepository $userRepository,
        IFriendsRepository $friendsRepository
    ) {
        $this->awardsRepository = $awardsRepository;
        $this->contestRepository = $contestRepository;
        $this->gameRepository = $gameRepository;
        $this->graphicsRepository = $graphicsRepository;
        $this->userRepository = $userRepository;
        $this->friendsRepository = $friendsRepository;
    }

    private static function builder(IDatabase $database)
    {
        return new RepositoryManager(
            new AwardsRepository($database),
            new ContestRepository($database),
            new GameRepository($database),
            new GraphicsRepository($database),
            new UserRepository($database),
            new FriendsRepository($database)
        );
    }

    public function getAwardsRepository(): IAwardsRepository
    {
        return $this->awardsRepository;
    }

    public function getContestRepository(): IContestRepository
    {
        return $this->contestRepository;
    }

    public function getGameRepository(): IGameRepository
    {
        return $this->gameRepository;
    }

    public function getGraphicsRepository(): IGraphicsRepository
    {
        return $this->graphicsRepository;
    }

    public function getUserRepository(): IUserRepository
    {
        return $this->userRepository;
    }

    public function getFriendsRepository(): IFriendsRepository
    {
        return $this->friendsRepository;
    }

    private static IRepositoryManager|null $value = null;

    /**
     * @deprecated Use $container = require(__DIR__ . "app/container") for repository resolution
     */
    public static function get(): IRepositoryManager
    {
        if (RepositoryManager::$value == null) {
            RepositoryManager::$value = RepositoryManager::builder(DatabaseManager::get()->getPostgresDatabase());
        }

        return RepositoryManager::$value;
    }
}
