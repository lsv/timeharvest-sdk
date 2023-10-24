<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;

trait TimeEntryCreatePreQueryTrait
{
    /**
     * @param array<string, mixed> $values
     */
    private function timeEntryPreQuery(array &$values): void
    {
        $values['project_id'] = $this->project instanceof ProjectInfoData ? $this->project->id : $this->project;
        $values['task_id'] = $this->task instanceof TaskInfoData ? $this->task->id : $this->task;
        if ($this->user) {
            $values['user_id'] = $this->user instanceof UserInfoData ? $this->user->id : $this->user;
        }
        $values['spent_date'] = $this->spentDate->format('Y-m-d');
    }
}
