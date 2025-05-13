<?php

namespace SploderRevival\Repositories;

use SploderRevival\Database\{IDatabase};

class AwardsRepository implements IAwardsRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }
}
