<?php

namespace App\Jobs;

use App\Http\Resources\NotificationResource;
// use App\Models\Notification;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

use App\Traits\ApiResponseTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendUserNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use ApiResponseTrait;
    protected $title;
    protected $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function handle()
    {

        $users=User::where('id','!=',auth()->id())->get();
         Notification::send($users,new UserNotification($this->title,$this->description));
         $notification = [
            'title'=>$this->title,
            'description'=>$this->description];
        return $this->NotificationResponse($notification);
    }
}
