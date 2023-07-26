<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ArticleServiceContract;
use App\Dto\Article\ArticlePaginationDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;
use App\Dto\Support\UploadFileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\GetFilteredArticlesRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Article\PaginatedArticlesResource;
use App\Models\Article;
use App\Support\StorageUploadSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $imageUrl = StorageUploadSupport::upload(new UploadFileDto(
            file: $request->file('image'),
            dir: 'articles',
        ));

        $response = $this->articleService->createArticle(new CreateArticleDto(
            title: $validated['title'],
            content: $validated['content'],
            isPublished: $validated['isPublished'] ?? false,
            imageUrl: $imageUrl,
            author: $request->user()->modelToDto()
        ));

        return $this->sendResponse(new ArticleResource($response));
    }

    public function update(UpdateRequest $request, Article $article)
    {
        $validated = $request->validated();

        $imageUrl = StorageUploadSupport::upload(new UploadFileDto(
            file: $request->file('image'),
            dir: 'articles',
            oldUrl: $article->image_url
        ));

        $response = $this->articleService->updateArticle(new UpdateArticleDto(
            id: $article->id,
            title: $validated['title'],
            content: $validated['content'],
            isPublished: $validated['isPublished'],
            imageUrl: $imageUrl
        ));

        return $this->sendResponse(['message' => 'Article updated successfully']);
    }

    public function delete(Request $request, int $id)
    {
        $response = $this->articleService->removeArticle(new RemoveArticleDto(
            id: $id,
            author: $request->user()->modelToDto()
        ));

        return $this->sendResponse(['message' => 'Article deleted successfully']);
    }

    public function getFilteredArticles(GetFilteredArticlesRequest $request)
    {
        $response = $this->articleService->getArticlesWithPagination(new ArticlePaginationDto(
            page: $request->get('page', 1),
            perPage: $request->get('per_page', 25)
        ));

        return $this->sendResponse(new PaginatedArticlesResource($response));
    }

    public function getArticleById(int $id)
    {
        $response = $this->articleService->getArticleById($id);

        return $this->sendResponse(new ArticleResource($response));
    }
}
