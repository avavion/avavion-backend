<?php

namespace App\Http\Resources\Article;

use App\Dto\Article\ArticleDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ArticleDto $this */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'isPublished' => $this->isPublished,
            'imageUrl' => $this->imageUrl,
            'author' => $this->author->username,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}
