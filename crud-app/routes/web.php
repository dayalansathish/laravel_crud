<?php

use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin/dashboard', [ProductController::class, 'index']);
// Route::get('/user/dashboard', [Usercontroller::class, 'index']);

// Route::get('/products/create', [ProductController::class, 'create']);
// Route::post('/products/store', [ProductController::class, 'store']);

// Route::get('/admin/products/{id}/show',[ProductController::class,'show']);
// Route::get('/products/{id}/show', [Usercontroller::class, 'show']);

// Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
// Route::put('/products/{id}/update', [ProductController::class, 'update']);

// Route::delete('/products/{id}/delete', [ProductController::class, 'destroy']);

//Auth

// Route::view('register', 'auth.register')->middleware('guest');
// Route::post('registerUser', [RegisterController::class, 'store']);
// Route::view('home', 'components.home');

// Route::view('/', 'auth.login')->middleware('guest');
// Route::post('loginUser', [LoginController::class, 'authenticate']);

// Route::get('logout', [LoginController::class, 'logout']);











Route::get("/", function () {
    return view("components.Home");
})->name('home-page');

// Route::redirect('/','/new');//we redirect users from an old URL to a new URL. ->302 found
// Route::permanentRedirect('/', '/new');//301 Moved Permanently -> status
Route::get("/new", function () {
    return view("components.new");
})->name('new-page');

// User routes
Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {

        // Login route
        // Route::get('login', [LoginController::class, 'index'])->name('account.login');
        // Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');

        Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('account.login');

        // Registration routes
        // Route::get('register', [RegisterController::class, 'index'])->name('account.register');
        // Route::post('registerProcess', [RegisterController::class, 'registerProcess'])->name('account.registerProcess');

        Route::match(['get', 'post'], 'register', [RegisterController::class, 'register'])->name('account.register');
    });

    Route::group(['middleware' => 'auth'], function () {

        // User dashboard and logout
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('products/{id}/show', [UserDashboardController::class, 'show'])->name('account.show');
        // Route to handle direct URL search parameter
        Route::get('/search/{search}', [ProductController::class, 'directSearch'])->where('search', '.*');
        // Route to handle search input from a form or query string
        Route::get('/search', [ProductController::class, 'search'])->name('search');
    });
});

// Admin routes
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin-guest'], function () {

        // Admin login
        Route::get('login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin-auth'], function () {

        //         // Admin dashboard and logout
//         Route::get('dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
//         Route::get('products/{id}/show', [ProductController::class, 'show'])->where(['id' => '[0-9]+'])->name('admin.show');
//         //         Route::get('products/{i_d}/show', function (string $id) {
// //             // dd($id);
// //             return 'Product '.$id;
// // })->where(['id' => '[0-9]+']);

        //         // Other admin routes
//         Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
//         Route::post('products/store', [ProductController::class, 'store'])->name('admin.products.store');
//         Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
//         Route::put('products/{id}/update', [ProductController::class, 'update'])->name('admin.products.update');
//         Route::delete('products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.products.destroy');
//         Route::get('products/details', [ProductController::class, 'adminCreatedProducts'])->name('admin.products.details');

        Route::controller(ProductController::class)->group(function () {
            Route::name('admin.')->group(function () {

                Route::get('dashboard', 'index')->name('dashboard');
                Route::get('products/{id}/show', 'show')->where(['id' => '[0-9]+'])->name('show');

                
                // Route::get('products/{id}/show', 'show')
                // ->where(['id' => '[0-9]+'])
                // ->name('show')
                // ->missing(function (Request $request) {
                //     dd($request);
                //     return redirect()->route('admin.dashboard')->with('error', 'Product not found');
                // });
                // // Route::get('products/{id}/show',function(User $user){
                //     return $user->email;

                // });


                // Other admin routes
                Route::get('products/create', 'create')->name('products.create');
                Route::post('products/store', 'store')->name('products.store');
                Route::get('products/{id}/edit', 'edit')->name('products.edit');    
                Route::put('products/{id}/update', 'update')->name('products.update');
                Route::delete('products/{id}/delete', 'destroy')->name('products.destroy');
                Route::get('products/trashed', 'trashed')->name('products.trashed');
                Route::put('products/{id}/restore', 'restore')->name('products.restore');
                Route::delete('products/{id}/forceDelete', 'forceDelete')->name('products.forceDelete');
                Route::get('products/details', 'adminCreatedProducts')->name('products.details');

            });


            Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
        });
    });
});

Route::get('forgot-password', [ForgotController::class, 'showForgot'])->name('show.forgot');
Route::post('forgot-password', [ForgotController::class, 'submitForgot'])->name('submit.forgot');
Route::get('reset-password', [ForgotController::class, 'showReset'])->name('show.reset');
Route::post('forgot-password', [ForgotController::class, 'submitForgot'])->name('submit.reset');



Route::fallback(function () {
    return redirect('/');
});














//auth for admin

// Group routes for admin access with a prefix
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     // Routes for admin dashboard
//     Route::get('/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
//     Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
//     Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
//     Route::get('/products/{id}/show', [ProductController::class, 'show'])->name('admin.products.show');
//     Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
//     Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('admin.products.update');
//     Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.products.destroy');
//     Route::get('logout', [LoginController::class, 'logout']);
// });
