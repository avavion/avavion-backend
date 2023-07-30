<?php

namespace Tests\Unit;

use App\Contracts\Repositories\ArticleRepositoryContract;
use App\Dto\Article\ArticlePaginationDto;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    private ArticleRepositoryContract $articleRepository;

    public function testGetAllArticlesWithPaginationFullSuccess(): void
    {
        DB::table('articles')->truncate();

        Article::factory(26)->create();

        $pagination = $this->articleRepository->getArticlesWithPagination(new ArticlePaginationDto(
            page: 1,
            perPage: 25
        ));

        $this->assertCount(25, $pagination->articles);
        $this->assertTrue($pagination->hasNextPage);
        $this->assertEquals(1, $pagination->currentPage);
    }

    public function testGetAllArticlesWithPaginationDoesNotHasNextPage(): void
    {
        DB::table('articles')->truncate();

        Article::factory(25)->create();

        $pagination = $this->articleRepository->getArticlesWithPagination(new ArticlePaginationDto(
            page: 1,
            perPage: 25
        ));

        $this->assertCount(25, $pagination->articles);
        $this->assertFalse($pagination->hasNextPage);
        $this->assertEquals(1, $pagination->currentPage);
    }

    public function testGetAllArticlesWithPaginationDoesNotHasNextPageAndPageTwo(): void
    {
        Article::factory(21)->create();

        $pagination = $this->articleRepository->getArticlesWithPagination(new ArticlePaginationDto(
            page: 2,
            perPage: 10
        ));

        $this->assertCount(10, $pagination->articles);
        $this->assertTrue($pagination->hasNextPage);
        $this->assertEquals(2, $pagination->currentPage);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(ArticleRepositoryContract::class, ArticleRepository::class);

        $this->articleRepository = $this->app->make(ArticleRepositoryContract::class);
    }
}
