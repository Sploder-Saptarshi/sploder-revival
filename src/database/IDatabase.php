<?php

namespace SploderRevival\database;

/**
 * Handles abstractions over querying a database
 */
interface IDatabase
{
  /**
   * Executes a $query with $parameters and returns the results
   * @param $query
   * @param $parameters
   * @param $mode
   * @return array
   */
    public function query(string $query, ?array $parameters = null, $mode = 0): array;

  /**
   * Executes a $query with $parameters and returns the first result
   * @param $query
   * @param $parameters
   * @param $mode
   * @return array
   */
    public function queryFirst(string $query, ?array $parameters = null, $mode = 0): mixed;

  /**
   * Executes a $query with $parameters and returns the first $column result
   * @param $query
   * @param $parameters
   * @param $column
   * @return array
   */
    public function queryFirstColumn(string $query, int $column = 0, ?array $parameters = null): mixed;

    /**
     * Returns a $query results as paginated + metadata on the pagination.
     *
     * Do not pass in $limit and $offset into the parameters, as this will be injected for you.
     *
     * @param $query
     * @param $limit
     * @param $offset
     * @param $parameters
     * @return PaginationData
     */
    public function queryPaginated(string $query, int $page, int $itemsPerPage, ?array $parameters = null): PaginationData;

  /**
   * Executes a $query with $parameters and returns if the query succeeded or not
   *
   * @param $query
   * @param $parameters
   * @return bool
   */
    public function execute(string $query, ?array $parameters = null): bool;

  /**
   * Within the block of $callable, a transaction scope will be created and committed. Any failures will rollback the transaction.
   *
   * @param $callback
   * @return mixedk
   */
    public function useTransactionScope(callable $callback): mixed;
}
