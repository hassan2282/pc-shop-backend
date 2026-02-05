<?php

namespace App\Repositories\AdmRepo\Conversation;

use App\Repositories\EloquentRepositoryInterface;

interface AdmConversationRepositoryInterface extends EloquentRepositoryInterface
{
    public function allWithLastTicket();
}
