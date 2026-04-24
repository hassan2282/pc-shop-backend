<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdmNotificationController extends Controller
{
    public function all()
{
    try {
        $admin = auth()->user();
        $notifications = $admin->notifications()->paginate(10);
        
        return response()->json([
            'total' => $notifications->total() / 10,
            'data'  => $notifications->items(),
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    };
}


    public function read(string $id)
    {
        $notif = auth()->user()->notifications()->find($id);
        if($notif){
            $notif->markAsRead();
        };
    }
}
