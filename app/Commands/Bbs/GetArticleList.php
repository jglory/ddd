<?php

namespace App\Commands\Bbs;

use App\Commands\Command;

/**
 * GetArticleList command
 */
class GetArticleList extends Command
{
    public readonly int $page;
    public readonly int $pageSize;

    /**
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(int $page, int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'page' => $this->page,
            'pageSize' => $this->pageSize,
        ];
    }
}
