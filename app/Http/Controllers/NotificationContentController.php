<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\NotificationContent;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class NotificationContentController extends Controller
{
    use ApiResponseTrait;
    public function sendNotification(Request $request){
        $notification=NotificationContent::create([
            'uuid'=>Str::uuid(),
            'title'=>$request->title,
            'description'=>$request->description
        ]);
        $users=User::where('id','!=',auth()->id())->get();
        Notification::send($users,new UserNotification($notification->title,$notification->description));
        return $this->NotificationResponse(new NotificationResource($notification));
    }

}
