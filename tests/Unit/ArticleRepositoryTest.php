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

    public function testGetAllArticlesWithPagination(): void
    {
        Article::factory(10)->create();

        $pagination = $this->articleRepository->getArticlesWithPagination(new ArticlePaginationDto(
            page: 1,
            perPage: 25
        ));

        $this->assertCount(25, $pagination->articles);
        $this->assertTrue($pagination->hasNextPage);
        $this->assertEquals(1, $pagination->currentPage);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(ArticleRepositoryContract::class, ArticleRepository::class);

        $this->articleRepository = $this->app->make(ArticleRepositoryContract::class);
    }
}