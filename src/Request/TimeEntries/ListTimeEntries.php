<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntriesResponse;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListTimeEntries extends AbstractRequest
{
    public function __construct(
        readonly private null|UserData|int $user = null,
        readonly private null|ClientInfoData|int $client = null,
        readonly private null|ProjectInfoData|int $project = null,
        readonly private null|TaskData|int $task = null,
        readonly public ?string $externalReferenceId = null,
        readonly public ?bool $isBilled = null,
        readonly public ?bool $isRunning = null,
        readonly public ?\DateTimeInterface $updatedSince = null,
        readonly private ?\DateTimeInterface $fromDate = null,
        readonly private ?\DateTimeInterface $toDate = null,
        readonly public ?MetaResponse $meta = null,
    ) {
    }

    public function getUri(): string
    {
        return '/time_entries';
    }

    protected function preQuery(array &$values): void
    {
        $fields = [
            'user' => ['user_id', UserData::class],
            'client' => ['client_id', ClientInfoData::class],
            'project' => ['project_id', ProjectInfoData::class],
            'task' => ['task_id', TaskData::class],
        ];

        foreach ($fields as $key => $data) {
            [$value, $instance] = $data;
            $element = $this->{$key};
            if ($element) {
                $values[$value] = $element;
                if ($element instanceof $instance) {
                    $values[$value] = $element->id;
                }
            }
        }

        if ($this->fromDate) {
            $values['from'] = $this->fromDate->format('Y-m-d');
        }

        if ($this->toDate) {
            $values['to'] = $this->toDate->format('Y-m-d');
        }
    }

    public function parseResponse(ResponseInterface $response): TimeEntriesResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $timeEntries = Serializer::deserializeArray($data['time_entries'], TimeEntryData::class.'[]');

        return new TimeEntriesResponse($meta, $timeEntries);
    }
}
