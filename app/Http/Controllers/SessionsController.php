<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //
    public function destroy(){
        //logout the current user
        auth()->logout();
        //redirect to homepage with a message in flashed variable
        return redirect('/')->with('success', 'Goodbye!');
    }
}
