<?php

namespace App\Http\Resources\Article;

use App\Dto\Article\ArticlePaginationResponseDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedArticlesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        /** @var ArticlePaginationResponseDto $this */

        return [
            'articles' => ArticleResource::collection($this->articles),
            'currentPage' => $this->currentPage,
            'perPage' => $this->perPage,
            'hasNextPage' => $this->hasNextPage
        ];
    }
}
