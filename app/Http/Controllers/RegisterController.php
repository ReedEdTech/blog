<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //vising the registration page
    public function create(){
        return view( 'register.create' );
    }

    //submitting info from the registration page
    public function store(){
        
        //if validation fails, Laravel will automatically redirect you to the form again
        $attributes = request()->validate([
            'name' => 'required|max:255|min:3',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7'
        ]);
        //*NOTE:  In User class we overrode the mutator for password
        //   so this will actually bcrypt the password as it is stored
        
        //dd($attributes);
        //If I made it here, then I passed validation
        //let's make us a user!
        User::create( $attributes );

        //send them back to the home page
        return redirect('/');

    }

}
