<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    // Actions
    public function __construct(){
        $this->middleware("auth:admin")->only('index');
    }

    public function index()
    {

        $user = "Eslam Badawy";
        $title = "Store";

        return view('dashboard.index',[
            'title'=> $title,
            'user'=> $user
        ]);
        // return view('dashboard' , compact("user" , "title"));
    }
}
