<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Response\MetaResponse;

trait PaginationTrait
{
    /**
     * @param array<string, mixed> $values
     */
    private static function setPagination(?MetaResponse $meta, array &$values): void
    {
        if (!$meta) {
            return;
        }

        if (!$nextPage = $meta->nextPage) {
            return;
        }

        /** @infection-ignore-all  */
        $query = (string) parse_url($nextPage, PHP_URL_QUERY);
        parse_str($query, $data);
        if (isset($data['page'])) {
            $values['page'] = (int) $data['page'];
        }

        if (isset($data['per_page'])) {
            $values['per_page'] = (int) $data['per_page'];
        }
    }
}
