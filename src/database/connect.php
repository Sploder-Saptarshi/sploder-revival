<?php

namespace SploderRevival\Database;

require_once(__DIR__ . '/idatabase.php');
require_once(__DIR__ . '/databasemanager.php');

/**
 * Retrieves a connection to the Postgres Database
 *
 * @return IDatabase
 */
function getDatabase(): IDatabase
{
    return DatabaseManager::get()->getPostgresDatabase();
}

/**
 * Retrieves a connection to the SQLite Database for the original members
 *
 * @return IDatabase
 */
function getOriginalMembersDatabase(): IDatabase
{
    return DatabaseManager::get()->getOriginalMembersDatabase();
}
