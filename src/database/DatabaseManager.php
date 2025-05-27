<?php

namespace SploderRevival\database;

/**
 * @deprecated Use container for resolution
 */
class DatabaseManager implements IDatabaseManager
{
    private IDatabase $postgresDatabase;
    private IDatabase $originalMembersDatabase;

    private function __construct(IDatabase $postgresDatabase, IDatabase $originalMembersDatabase)
    {
        $this->postgresDatabase = $postgresDatabase;
        $this->originalMembersDatabase = $originalMembersDatabase;
    }

    public function getPostgresDatabase(): IDatabase
    {
        return $this->postgresDatabase;
    }

    public function getOriginalMembersDatabase(): IDatabase
    {
        return $this->originalMembersDatabase;
    }

    private static IDatabaseManager|null $value = null;

  /**
   * Retrieves the singleton instance of the DatabaseManager
   * @deprecated Use container for resolution
   */
    public static function get(): IDatabaseManager
    {
        if (DatabaseManager::$value == null) {
            require_once(__DIR__ . '/../config/env.php');

            // Postgres
            $host = getenv("POSTGRES_HOST");
            $port = getenv("POSTGRES_PORT");
            $database = getenv("POSTGRES_DB");
            $username = getenv("POSTGRES_USERNAME");
            $password = getenv("POSTGRES_PASSWORD");
            $sslmode = getenv("POSTGRES_SSLMODE");
            $dsn = "pgsql:host=$host;port=$port;dbname=$database;user=$username;password=$password;sslmode=$sslmode";
            $postgresDatabase = new SqlDatabase(new ConnectionManager($dsn));

            // Original Members DB
            $originalMembersDbFile = getenv("ORIGINAL_MEMBERS_DB");

            if (isset($originalMembersDbFile) && trim($originalMembersDbFile) !== '') {
                $originalMembersSqliteFile = 'sqlite:../database/' . $originalMembersDbFile . '.db';
                $originalDatabase = new SqlDatabase(new ConnectionManager($originalMembersSqliteFile));
            } else {
                throw new \Exception("ORIGINAL_MEMBERS_DB SQLITE must be provided");
                // $originalDatabase = null;
            }
            DatabaseManager::$value = new DatabaseManager($postgresDatabase, $originalDatabase);
        }

        return DatabaseManager::$value;
    }
}
