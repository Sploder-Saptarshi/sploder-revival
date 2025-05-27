<?php

// namespace SploderRevival\database;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/ContainerBuilder.php';

use SploderRevival\app\ContainerBuilder;
use SploderRevival\database\IDatabase;

/**
 * Retrieves a connection to the Postgres Database
 *
 * @return IDatabase
 */
function getDatabase(): IDatabase
{
    return ContainerBuilder::getInstance()->get(IDatabase::class);
}

/**
 * Retrieves a connection to the SQLite Database for the original members
 *
 * @return IDatabase
 */
function getOriginalMembersDatabase(): IDatabase
{
    return ContainerBuilder::getInstance()->get("OriginalMembersSqlDatabase");
}
