<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    // Actions

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
