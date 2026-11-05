<?php

namespace Src\Products\Application\DTOs;

use Illuminate\Http\Request;

class ListProductDTO
{
    public function __construct(
        public int $page,
        public int $perPage,
        public string $search = '',
        public string $sort = 'created_at',
        public string $sortDirection = 'desc',
    ) {}
    public static function fromRequest(Request $request): self
    {
        return new self(
            page: $request->input('page', 1),
            perPage: $request->input('perPage', 10),
            search: $request->input('search', ''),
            sort: $request->input('sort', 'created_at'),
            sortDirection: $request->input('sortDirection', 'desc'),
        );
    }
}