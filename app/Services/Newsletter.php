<?php 

namespace App\Services;

class Newsletter{

    public function subscribe( string $email , string $list = null ){

        //default to this list
        // ?? means use $list parameter if it has a value.  If NOT, then use config(...)
        $list ??= config('services.mailchimp.lists.subscribers');
 
        return $this->client()->lists->addListMember( $list , [
            "email_address" => request('email'),
            "status" => "subscribed",
        ]);   

    }//end subscribe

    public function client(){
        $mailchimp = new \MailchimpMarketing\ApiClient();
    
        return $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us14'
        ]);
        
    }

}