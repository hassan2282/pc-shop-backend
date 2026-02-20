<?php

namespace App\Services;

use App\Repositories\AdmRepo\Conversation\AdmConversationRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;

class TicketService
{

    public function __construct(
        readonly protected TicketRepositoryInterface $ticket_repository,
        readonly protected AdmConversationRepositoryInterface $conversation_repository
    ) {}

    public function show(int $id)
    {
        $conversation = $this->conversation_repository->where('user_id', $id)->first();
        if ($conversation) {
            $find = $this->conversation_repository->find($conversation->id);
            $tickets = $find->tickets;
            return [$conversation, $tickets];
        }
    }


    public function store(array $data)
    {
        try {
            if (isset($data['conversation_id'])) {
                $ticket = $this->ticket_repository->create([
                    'conversation_id' => $data['conversation_id'],
                    'text' => $data['text'],
                ]);
            } else {
                $conversation = $this->conversation_repository->create(['user_id' => $data['user_id']]);
                $ticket = $this->ticket_repository->create([
                    'conversation_id' => $conversation->id,
                    'text' => $data['text'],
                ]);
            };
            return $ticket;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function destroy($id)
    {
        $target = $this->ticket_repository->find($id);
        if ($target && !$target->admin_id) {
            return $target->delete();
        }
    }
}
