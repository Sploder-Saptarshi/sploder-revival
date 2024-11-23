<?php
interface IDatabase
{
  /**
   * Executes a $query with $parameters and returns the results
   * @param $query
   * @param $parameters
   * @return array
   */
  public function query(string $query, array $parameters = []): array;

  /**
   * Executes a $query with $parameters and returns the first result
   * @param $query
   * @param $parameters
   * @return array
   */
  public function queryFirst(string $query, array $parameters = []): mixed;

  /**
   * Executes a $query with $parameters and returns the first $column result
   * @param $query
   * @param $parameters
   * @param $column
   * @return array
   */
  public function queryFirstColumn(string $query, int $column = 0, array $parameters = []): mixed;

  /**
   * Executes a $query with $parameters and returns if the query succeeded or not
   *
   * @param $query
   * @param $parameters
   * @return bool
   */
  public function execute(string $query, array $parameters = []): bool;
}

class Database implements IDatabase
{
  private PDO $connection;

  function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  function query(string $query, array $parameters = []): array
  {
    $statement = $this->connection->prepare($query);
    $statement->execute($parameters);
    return $statement->fetchAll();
  }

  function queryFirst(string $query, array $parameters = []): mixed
  {
    $statement = $this->connection->prepare($query);
    $statement->execute($parameters);
    return $statement->fetch();
  }

  function queryFirstColumn(string $query, int $column = 0, array $parameters = []): mixed
  {
    $statement = $this->connection->prepare($query);
    $statement->execute($parameters);
    return $statement->fetchColumn($column);
  }

  function execute(string $query, array $parameters = []): bool
  {
    $statement = $this->connection->prepare($query);
    return $statement->execute($parameters);
  }
}