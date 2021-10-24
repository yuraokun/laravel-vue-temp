<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
// use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\testController;
use App\Http\Controllers\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/purchase', [UserController::class,'purchase']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('/products', ProductController::class);


// if you want to authenticate user who uses an api
Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::get('/products/search/{name}', [ProductController::class,'search']);

        Route::post('/logout', [AuthController::class, 'logout']);
});



// Route::resource('/test', testController::class);


// Route::post('/products', [ProductController::class,'purchase']);



//////// practice
// Route::get('/fun/{day?}', function($day) {
//    return $day . "ago";
// });

$posts = array("honda", "tanaka", "kuroda");

Route::get('/contact/{id}', function($id) use($posts){

   abort_if(!isset($posts[$id]), 404);
   return response($posts[$id], 201);
})->name('contact.id');

Route::get('/fun/responses', function() {
   return response("honda", 201)
   ->header('Content-Type', 'application/json')
   ->cookie('Mycookie', 'honda san', 3600);
});


Route::get('/fun/responses', function() {
   return response("honda", 201)
   ->header('Content-Type', 'application/json')
   ->cookie('Mycookie', 'honda san', 3600);
});

Route::get('/fun/redirect', function() {
        return redirect('/api/products');
});

Route::get('/fun/back', function() {
        //一つ前に戻す
        return back();
});

Route::get('/fun/name-route', function() {
       return redirect()->route('contact.id', ["id" => 1]);
});

Route::get('/fun/away', function() {
       return redirect('https://google.com');
});


Route::get('/fun/json', function() use($posts){
       return response()->json($posts);
});

Route::get('/fun/download', function() use($posts){
       return response()->download(public_path('/whoel.png'), 'kujira.png');
});


Route::prefix('/fun')->name('fun.')->group(function() use($posts){
        Route::get('group-test', function() use($posts) {
                return array_merge($posts, array("group-test" => "ok"));
        })->name('group-test');
});

// to get url params
Route::get('/posts', function() {
//        dd(request()->all());

        // dd(request()->input('key', 5));
        // left request key : right default value if no key exists

          dd(request()->query('key', 5));
        
        // return request()->all();
});


Route::get('/bool', function() {
    return request()->boolean('isOk');
});

Route::get('/has', function() {
    return request()->has('isOk');
});

Route::get('/whenhas', function() {
    $result = request()->whenHas('name', function($num) {
        return $num + 2;
    });
    return $result;
});

Route::get('/hasAny', function() {
    $result = request()->hasAny(['name', 'key'], function($nums) {
        return $nums;
    });
    return $result;
});

Route::get('filled', function() {
    if(request()->filled('name')) {
            return "ok";
    }
});

Route::get('auth', function() use($posts) {
    return $posts;
})->middleware('auth');


Route::auth();
Route::post('find', [testController::class, "find"]);
Route::get('test-show/{id}', [testController::class, "show"]);




// Route::get('email/verify/{id}/{code}', [UserController::class, 'email_verify']);

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::post('admin/register', [AdminController::class, 'register']);

Route::post('user/register', [UserController::class, 'register']);


Route::middleware('auth:admins')->prefix('admin/')->name('admin.')->group(function() {

    Route::get('test', [AdminController::class, 'test']);

});

Route::middleware('auth:users')->prefix('user/')->name('user.')->group(function() {

    Route::get('test', [UserController::class, 'test']);

});


// Route::get('login', [testController::class, 'login'])->name('login');    



Route::get('login', function() {
    // dd(auth()->check());
    // dd(auth()->guest());
 
    dd(auth()->user());
    return "you are not authenticated";
})->name('login');    