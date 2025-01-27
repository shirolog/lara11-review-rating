<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




//registerページに関する記述
Route::get('/register', [UserController::class, 'register'])
->name('user.register');
Route::post('/register', [UserController::class, 'register_store'])
->name('user.register_store');

//loginページに関する記述
Route::get('/login', [UserController::class, 'login'])
->name('user.login');
Route::post('/login', [UserController::class, 'authenticate'])
->name('user.authenticate');




Route::group(['middleware' => 'auth'], function(){

    //all_postsページに関する記述
    Route::get('/', [UserController::class, 'all_posts'])
    ->name('user.all_posts');
    
    //edit_profileページに関する記述
    Route::get('/edit_profile/{user}', [UserController::class, 'edit_profile'])
    ->name('user.edit_profile');
    Route::put('/edit_profile/{user}', [UserController::class, 'profile_update'])
    ->name('user.profile_update');
    Route::post('/delete_profile_image/{user}', [UserController::class, 'profile_img_destroy'])
    ->name('user.profile_img_destroy');
    
    //view_postページに関する記述
    Route::get('/view_post/{post}', [UserController::class, 'view_post'])
    ->name('user.view_post');    
    Route::delete('/view_post/{review}', [UserController::class, 'view_post_destroy'])
    ->name('user.view_post_destroy');


    
    //add_viewページに関する記述
    Route::get('/add_view/{post}', [UserController::class, 'add_view'])
    ->name('user.add_view');
    Route::post('/add_view/{post}', [UserController::class, 'add_view_store'])
    ->name('user.add_view_store');


    
    //edit_reviewページに関する記述
    Route::get('/edit_review/{review}', [UserController::class, 'edit_review'])
    ->name('user.edit_review');
    
    
    //logout処理に関する記述
    
    Route::get('/logout', [UserController::class, 'logout'])
    ->name('user.logout');
});

