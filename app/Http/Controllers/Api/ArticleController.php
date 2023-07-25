<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ArticleServiceContract;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\DeleteRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct(
        private ArticleServiceContract $articleService
    )
    {
    }

    public function create(CreateRequest $request)
    {
        $validated = $request->validated();

        $response = $this->articleService->createArticle(new CreateArticleDto(
            title: $validated['title'],
            content: $validated['content'],
            isPublished: $validated['isPublished'] ?? false,
            imageUrl: $validated['image'],
            author: $request->user()->modelToDto()
        ));

        return $this->sendResponse();
    }

    public function update(UpdateRequest $request)
    {
        $validated = $request->validated();

        $response = $this->articleService->updateArticle(new UpdateArticleDto(
            id: $validated['articleId'],
            title: $validated['title'],
            content: $validated['content'],
            isPublished: $validated['isPublished'] ?? false,
            imageUrl: $validated['image']
        ));

        return $this->sendResponse();
    }

    public function delete(DeleteRequest $request)
    {
        $validated = $request->validated();

        $response = $this->articleService->removeArticle(new RemoveArticleDto(
            id: $validated['articleId'],
            author: $request->user()->modelToDto()
        ));

        return $this->sendResponse();
    }
}
