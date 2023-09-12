<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //

    public function __invoke( Newsletter $newsletter ){
        //require_once('/path/to/MailchimpMarketing/vendor/autoload.php');
        request() ->validate(['email' => 'required|email']);
            
        try{     
            //weird trick:  require a hard-typed Newsletter paramater
            //    Laravel will just instantiate one for you 
            //    now you just call it by name
            $newsletter->subscribe( request('email') );
        }
        catch( \Exception $e){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }
        //ddd($response);
        return redirect('/')->with( 'success', 'You are now signed up for our newsletter!' );
    }

}
