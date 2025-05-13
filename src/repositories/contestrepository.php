<?php

namespace SploderRevival\Repositories;

use SploderRevival\Database\{IDatabase};

require_once(__DIR__ . "/../database/idatabase.php");
require_once(__DIR__ . "/icontestrepository.php");

class ContestRepository implements IContestRepository
{
    private readonly IDatabase $db;

    function __construct(IDatabase $db)
    {
        $this->db = $db;
    }
}
