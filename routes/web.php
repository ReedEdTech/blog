<?php



use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Spatie\YamlFrontMatter\Document;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'] )->name('home');

//{post} is a wildcard
//value gets passed to function (& named $slug)
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//registration page
Route::get( 'register' , [RegisterController::class, 'create'] )->middleware('guest');
Route::post( 'register' , [RegisterController::class, 'store'] )->middleware('guest');

//logging out
Route::post( 'logout', [SessionsController::class, 'destroy'] )->middleware('auth');

//logging in
Route::get( 'login', [SessionsController::class, 'create'] )->middleware('guest');
Route::post( 'login', [SessionsController::class, 'store'] )->middleware('guest');

//comments
Route::post( 'posts/{post:slug}/comments', [PostCommentsController::class, 'store'] )->middleware('auth');

//playing with mailchimp
Route::get( 'ping' , function(){
    //require_once('/path/to/MailchimpMarketing/vendor/autoload.php');

    $mailchimp = new \MailchimpMarketing\ApiClient();
    
    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us14'
    ]);
    
    //$response = $mailchimp->ping->get();
    //$response = $mailchimp->lists->getAllLists();
    //$response = $mailchimp->lists->getList("cb7acb323a");
    $response = $mailchimp->lists->addListMember("cb7acb323a", [
        "email_address" => "Shemar56@yahoo.com",
        "status" => "subscribed",
    ]);

    ddd($response);
});