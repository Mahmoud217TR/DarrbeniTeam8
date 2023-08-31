<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //  if (Auth::attempt(['email' => 'admin@admin.com', 'password' => '12345678'])) {

        return view('dashboard.layout.dashboard');
    // } else {
    //     return redirect()->route('login');
    // }
      
    }
}
