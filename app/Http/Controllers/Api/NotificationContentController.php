<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Jobs\SendUserNotification;
use App\Models\NotificationContent;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class NotificationContentController extends Controller
{
    use ApiResponseTrait; 
    public function sendNotification(Request $request)
    {
        $notification = NotificationContent::create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description
        ]);

        dispatch(new SendUserNotification($notification->title, $notification->description));

        return $this->NotificationResponse(new NotificationResource($notification));
    }

    
      
    public function getUserNotifications()
    {
        
        $user = Auth::user();
        if ($user) {
            $notifications = $user->notifications;
            $data = [];
    
            foreach ($notifications as $notification) {
                $data[] = [
                    'title' => $notification->data['title'],
                    'description' => $notification->data['description'],
                ];
            }
    
            return response()->json($data);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
}

}
