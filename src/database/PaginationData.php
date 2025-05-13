<?php

namespace SploderRevival\Database;

class PaginationData
{
    public readonly array $data;
    public readonly int $totalCount;
    public readonly int $totalPages;

    public function __construct(array $data, int $totalCount, int $totalPages)
    {
        $this->data = $data;
        $this->totalCount = $totalCount;
        $this->totalPages = $totalPages;
    }
}
