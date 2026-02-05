<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Conversation\StoreConversationRequest;
use App\Http\Requests\Admin\Conversation\UpdateConversationRequest;
use App\Repositories\AdmRepo\Conversation\AdmConversationRepositoryInterface;

class AdmConversationService extends BaseService
{
    public function __construct(AdmConversationRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreConversationRequest::class, UpdateConversationRequest::class);
    }

    public function allWithLastTicket()
    {
        return $this->repository->allWithLastTicket();
    }
}