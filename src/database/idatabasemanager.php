<?php

namespace SploderRevival\Database;

/**
 * @deprecated Use $container = require(__DIR__ . "app/container") for database resolution
 */
interface IDatabaseManager
{
    public function getPostgresDatabase(): IDatabase;
    public function getOriginalMembersDatabase(): IDatabase;
}
