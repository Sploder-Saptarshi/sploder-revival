<?php

/**
 * Handles database interations with users
 */
interface IUserRepository
{
    /**
     * Checks if a user exists
     * @param $userName
     * @return true if exists, false otherwise
     */
    function exists(string $userName): bool;

  /**
   * Search for similar users by userName
   *
   * @param $userName
   * @param $limit
   * @return the array of search values
   */
    function search(string $userName, int $limit = 180);

    /**
     * Get top 90 members which have the most views per day
     * 
     * @return array of top users
     */
    function getTopMembers();

    /**
     * Get 100 members with offset
     * 
     * @param $offset
     * @return array of users
     */
    function getMembers(int $offset);

    /**
     * Get total number of members
     * 
     * @return int total number of members
     */
    function getTotalNumberOfMembers(): int;

    /**
     * Get level of user by user ID
     * 
     * @param $userId
     * @return int level of user
     */
    function getLevelByUserId(int $userId);

    /**
     * Save event data
     * 
     * @param $s
     * @param $e
     * @param $g
     * @return void
     */
    function saveEvent(string $s, string $e, string $g);
}
