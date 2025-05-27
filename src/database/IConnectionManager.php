<?php

namespace SploderRevival\database;

/**
 * Handles the state for PDO connections
 */
interface IConnectionManager
{
  /**
   * Retrieves the connection to a specified database
   */
    public function getConnection(): \PDO;
}
