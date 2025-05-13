<?php

namespace SploderRevival\Database;

use SploderRevival\Database\{IDatabase};
use SploderRevival\App\ContainerBuilder;

require_once(__DIR__ . '/idatabase.php');
require_once(__DIR__ . '/databasemanager.php');

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
