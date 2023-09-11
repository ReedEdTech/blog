<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    //
    public function destroy(){
        $user = auth()->user()->name;
        //logout the current user
        auth()->logout();
        //redirect to homepage with a message in flashed variable
        return redirect('/')->with('success', 'Goodbye, '. $user );
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(){
        //validate the request (be sure of valid input values)
        $attributes = request()->validate([            
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:7'
        ]);
        //attempt to authenticate & log in the user (based on provided credentials)
        $signedIn = auth()->attempt( $attributes );

        if( !$signedIn ){ //failed authentication
            throw ValidationException::withMessages([
                'email' => 'Your credentials could not be verified.'
            ]);
        }

        //still here?  validation worked
        session()->regenerate(); //this helps prevent a Session Fixation attack
        
        //redirect w/success flash message        
        return redirect('/')->with('success', 'Welcome Back, '. auth()->user()->name .'!');

    }
}
