<?php

namespace SploderRevival\Repositories;

/**
 * Handles database interations with friends
 */
interface IFriendsRepository
{
    /**
     * Gets the number of unviewed friends
     *
     * @param $userId the user to check for friends
     * @param $isViewed whether the friend request has been viewed
     * @return the number of friends
     */
    public function getFriendRequestCount(int $userId, bool $isViewed): int;

    /**
     * Views all friend requests for a user
     */
    public function setAllFriendsAsViewed(int $userId): void;
}
