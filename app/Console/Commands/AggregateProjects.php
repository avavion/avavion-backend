<?php

namespace App\Console\Commands;

use App\Contracts\Services\ProjectServiceContract;
use Illuminate\Console\Command;

class AggregateProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:aggregate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Аггрегация проектов из различных систем';

    /**
     * Execute the console command.
     */
    public function handle(ProjectServiceContract $service): bool
    {
        return $service->createOrUpdateProjectWithSystem();
    }
}
