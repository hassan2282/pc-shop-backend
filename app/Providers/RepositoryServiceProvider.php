<?php

namespace App\Providers;

use App\Repositories\AdmRepo\User\AdmUserRepository;
use App\Repositories\AdmRepo\User\AdmUserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
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
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
        $this->app->bind(AdmUserRepositoryInterface::class, AdmUserRepository::class);
    }

}
