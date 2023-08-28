<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class FilterDTO extends DataTransferObject
{
    public ?int $priceFrom;
    public ?int $priceTo;
    public ?array $brands;
    public ?array $optionValueIds;
    public ?string $sort;
    public ?string $search;

    public static function formRequest(array $params): self
    {
        return new self([
            'priceFrom' => $params['filters']['price']['from'] ?? null,
            'priceTo' => $params['filters']['price']['to'] ?? null,
            'brands' => $params['filters']['brands'] ?? null,
            'optionValueIds' => $params['filters']['optionValueIds'] ?? null,
            'sort' => $params['sort'] ?? null,
            'search' => $params['search'] ?? null,
        ]);
    }
}
