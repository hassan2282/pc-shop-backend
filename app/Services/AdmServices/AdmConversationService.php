<?php

namespace App\Services\AdmServices;

use App\Filters\TicketFilter;
use App\Http\Requests\Admin\Conversation\StoreConversationRequest;
use App\Http\Requests\Admin\Conversation\UpdateConversationRequest;
use App\Repositories\AdmRepo\Conversation\AdmConversationRepositoryInterface;

class AdmConversationService extends BaseService
{
    public function __construct(AdmConversationRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreConversationRequest::class, UpdateConversationRequest::class);
    }

    public function allWithFilters()
    {
        $queryParams = [
            'q' => request()->q,
            'role' => request()->role,
        ];
        try {
            $query = $this->repository->query();
            $filter = (new TicketFilter($queryParams, 5, $query))->getResult();
            return response()->json($filter);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}