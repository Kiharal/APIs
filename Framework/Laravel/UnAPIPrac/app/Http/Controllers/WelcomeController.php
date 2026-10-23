<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController extends Controller
{
    public function __invoke(){
        $users = User::all();

        return view('view', compact('users'));

    }

}
