<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project;

use Lsv\TimeharvestSdk\Response\MetaResponse;

readonly class ProjectsResponse
{
    /**
     * @param ProjectData[] $projects
     */
    public function __construct(
        private MetaResponse $meta,
        private array $projects,
    ) {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return ProjectData[]
     */
    public function getData(): array
    {
        return $this->projects;
    }
}
