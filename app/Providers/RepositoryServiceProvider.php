<?php

namespace App\Providers;

use App\Repositories\AdmRepo\Article\AdmArticleRepository;
use App\Repositories\AdmRepo\Article\AdmArticleRepositoryInterface;
use App\Repositories\AdmRepo\Category\AdmCategoryRepository;
use App\Repositories\AdmRepo\Category\AdmCategoryRepositoryInterface;
use App\Repositories\AdmRepo\Permission\AdmPermissionRepository;
use App\Repositories\AdmRepo\Permission\AdmPermissionRepositoryInterface;
use App\Repositories\AdmRepo\Product\AdmProductRepository;
use App\Repositories\AdmRepo\Product\AdmProductRepositoryInterface;
use App\Repositories\AdmRepo\Role\AdmRoleRepository;
use App\Repositories\AdmRepo\Role\AdmRoleRepositoryInterface;
use App\Repositories\AdmRepo\Tag\AdmTagRepository;
use App\Repositories\AdmRepo\Tag\AdmTagRepositoryInterface;
use App\Repositories\AdmRepo\User\AdmUserRepository;
use App\Repositories\AdmRepo\User\AdmUserRepositoryInterface;
use App\Repositories\AdmRepo\Ticket\AdmTicketRepository;
use App\Repositories\AdmRepo\Ticket\AdmTicketRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\AdmRepo\Conversation\AdmConversationRepository;
use App\Repositories\AdmRepo\Conversation\AdmConversationRepositoryInterface;
use App\Repositories\AdmRepo\EditorMedia\AdmEditorMediaRepository;
use App\Repositories\AdmRepo\EditorMedia\AdmEditorMediaRepositoryInterface;
use App\Repositories\AdmRepo\Gate\AdmGateRepository;
use App\Repositories\AdmRepo\Gate\AdmGateRepositoryInterface;
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
        $this->app->bind(AdmRoleRepositoryInterface::class, AdmRoleRepository::class);
        $this->app->bind(AdmPermissionRepositoryInterface::class, AdmPermissionRepository::class);
        $this->app->bind(AdmCategoryRepositoryInterface::class, AdmCategoryRepository::class);
        $this->app->bind(AdmArticleRepositoryInterface::class, AdmArticleRepository::class);
        $this->app->bind(AdmProductRepositoryInterface::class, AdmProductRepository::class);
        $this->app->bind(AdmTagRepositoryInterface::class, AdmTagRepository::class);
        $this->app->bind(AdmTicketRepositoryInterface::class, AdmTicketRepository::class);
        $this->app->bind(AdmConversationRepositoryInterface::class, AdmConversationRepository::class);
        $this->app->bind(AdmEditorMediaRepositoryInterface::class, AdmEditorMediaRepository::class);
        $this->app->bind(AdmGateRepositoryInterface::class, AdmGateRepository::class);
    }

}
