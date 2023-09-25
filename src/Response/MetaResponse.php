<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response;

class MetaResponse
{
    public int $perPage;
    public int $totalPages;
    public int $totalEntries;
    public ?string $nextPage = null;
    public ?string $previousPage = null;
    public int $page;

    /**
     * @phpstan-var array{first: string|null, next: string|null, previous: string|null, last: string|null}
     */
    public array $links = [
        'first' => null,
        'next' => null,
        'previous' => null,
        'last' => null,
    ];
}
