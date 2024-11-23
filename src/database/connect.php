<?php
require_once(__DIR__ . '/../config/env.php');
require_once(__DIR__ . '/database.php');

/**
 * @deprecated use "getDatabase" moving forward, as this will be deleted
 *
 * Returns a connection to the Postgres database
 * @return PDO
 */
function connectToDatabase($table = null): PDO
{
    $host = getenv("POSTGRES_HOST");
    $port = getenv("POSTGRES_PORT");
    $database = getenv("POSTGRES_DB");
    $username = getenv("POSTGRES_USERNAME");
    $password = getenv("POSTGRES_PASSWORD");
    $sslmode = getenv("POSTGRES_SSLMODE");
    $dsn = "pgsql:host=$host;port=$port;dbname=$database;user=$username;password=$password;sslmode=$sslmode";
    try {
        $connection = new PDO($dsn);
        return $connection;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}

/**
 * Retrieves a connection to the Postgres Database
 * @return IDatabase
 */
function getDatabase(): IDatabase
{
    return new Database(connectToDatabase());
}