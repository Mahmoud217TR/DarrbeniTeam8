<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\NotificationContent;
use App\Models\User;
use App\Notifications\UserNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class NotificationContentController extends Controller
{
    public function create(){
        return view('dashboard.pages.notification.form');

    }

    public function store(Request $request){
        $notification=NotificationContent::create([
            'uuid'=>Str::uuid(),
            'title'=>$request->title,
            'description'=>$request->description
        ]);
        // $users=User::where('id','!=',auth()->id())->get();
        $users=User::all();
        Notification::send($users,new UserNotification($notification->title,$notification->description));
        return redirect()->route('notification.index')->with('notification  created successfully and send all');
    }
    public function index(){
        $notification=NotificationContent::all();
        return view('dashboard.pages.notification.index',compact('notification'));

    }
     // ********************************************8
    // ********************************************
    // *************Delete************************
    // *******************************************
    public function destroy($uuid)
    {
        $Notification = NotificationContent::where('uuid', $uuid)->first();


        $Notification->delete();
  
            return redirect()->back();
        }
    
    
    
        public function showsoft()
        {
            $notification = NotificationContent::onlyTrashed()->get();
            return view('dashboard.pages.notification.recycleBin', compact('notification'));
        }
        public function restor($uuid)
        {
            NotificationContent::withTrashed()->where('uuid', $uuid)->restore();
            return redirect()->back();
        }
    
    
        public function finaldelete($uuid)
        {
            $Notification = NotificationContent::withTrashed()->where('uuid', $uuid)->first();
    
       
            $Notification->forceDelete();
    
            return redirect()->back();
        }
    }
    