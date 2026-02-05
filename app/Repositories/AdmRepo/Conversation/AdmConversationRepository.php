<?php

namespace App\Repositories\AdmRepo\Conversation;

use App\Models\Conversation;
use App\Repositories\BaseRepository;

class AdmConversationRepository extends BaseRepository implements AdmConversationRepositoryInterface
{
    public function __construct(Conversation $conversation)
    {
        parent::__construct($conversation);
    }

    public function allWithLastTicket()
    {
        $data = Conversation::with(['tickets' => function ($query){
            $query->orderBy('created_at','DESC')->limit(1)->get();
        }])->orderBy('id','DESC')->get();
        return response()->json($data);
    }
}