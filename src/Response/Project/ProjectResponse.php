<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class ProjectResponse implements ResponseInterface
{
    public function __construct(
        private ProjectData $project,
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): ProjectData
    {
        return $this->project;
    }
}
