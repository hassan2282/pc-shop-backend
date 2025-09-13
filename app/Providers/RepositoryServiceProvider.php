<?php

namespace App\Providers;

use App\Repositories\Media\MediaRepository;
use App\Repositories\Media\MediaRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
    }

}
