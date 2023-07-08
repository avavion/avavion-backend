<?php

namespace Database\Factories;

use App\Enums\ProjectSystemEnum;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'is_published' => $this->faker->boolean(),
            'content' => $this->faker->word(),
            'instance_id' => $this->faker->numberBetween(111_111, 999_999_999),
            'url' => $this->faker->url(),
            'stars' => $this->faker->randomNumber(),
            'system' => collect(ProjectSystemEnum::getAllSystems())->random(1)->first()->value
        ];
    }
}
