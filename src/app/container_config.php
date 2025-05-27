<?php

require __DIR__ . '/../vendor/autoload.php';

use SploderRevival\database\{
    IConnectionManager,
    IDatabase,
    IDatabaseManager,
    ConnectionManager,
    SqlDatabase,
    DatabaseManager};
use SploderRevival\Repositories\{
    RepositoryManager,
    AwardsRepository,
    ContestRepository,
    FriendsRepository};
use SploderRevival\Services\{
    IGameListRenderService,
    GameFeedService,
    GameListRenderService};

use function DI\create;
use function DI\factory;

use Psr\Container\ContainerInterface;

require_once(__DIR__ . '/../config/env.php');

return [
    // Databases
    IConnectionManager::class => factory(function () {
        // TODO: we shoudl really just switch to "POSTGRES_CONNECTION" and call it a day
        $host = getenv("POSTGRES_HOST");
        $port = getenv("POSTGRES_PORT");
        $database = getenv("POSTGRES_DB");
        $username = getenv("POSTGRES_USERNAME");
        $password = getenv("POSTGRES_PASSWORD");
        $sslmode = getenv("POSTGRES_SSLMODE");
        $dsn = "pgsql:host=$host;port=$port;dbname=$database;user=$username;password=$password;sslmode=$sslmode";
        return new ConnectionManager($dsn);
    }),
    IDatabase::class => create(SqlDatabase::class),
    "OriginalMembersSqlDatabase" => factory(function () {
        $originalMembersDbFile = getenv("ORIGINAL_MEMBERS_DB");
        $originalMembersSqliteFile = 'sqlite:../database/' . $originalMembersDbFile . '.db';
        return new SqlDatabase(new ConnectionManager($originalMembersSqliteFile));
    }),
    // Repositories
    IAwardsRepository::class => create(AwardsRepository::class),
    IContestRepository::class => create(ContestRepository::class),
    IFriendsRepository::class => create(FriendsRepository::class),
    IGameRepository::class => create(GameRepository::class),
    IGraphicsRepository::class => create(GraphicsRepository::class),
    // Services
    IGameFeedService::class => create(GameFeedService::class),
    IGameListRenderService::class => create(GameListRenderService::class),
    // Backwards compatibility for Managers
    IDatabaseManager::class => factory(function (ContainerInterface $c) {
        return new DatabaseManager($c->get(IDatabase::class), $c->get("OriginalMembersSqlDatabase"));
    }),
    IRepositoryManager::class => create(RepositoryManager::class),
];
