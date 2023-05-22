<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\MailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create someth

ing great!
|
*/



Auth::routes();



Route::get('/', [App\Http\Controllers\postsController::class, 'index']);
Route::get('/posts/create', [App\Http\Controllers\postsController::class, 'create'])->middleware('auth');;
Route::post('/posts/store', [App\Http\Controllers\postsController::class, 'store'])->middleware('auth');
Route::get('/posts/{post}', [App\Http\Controllers\postsController::class, 'show']);

Route::resource('/adminpanel/categories',categoryController::class);
Route::post('/categories/{id}',[categoryController::class,'store'])->middleware('auth');
Route::delete('/categories/{id}',[categoryController::class,'destroy'])->middleware('auth');

Route::post('/addSubcategory/{category_id}',[categoryController::class,'addSubcategory'])->middleware('auth');

/* comments and likes*/
Route::post('/makecomment/{post_id}',[postsController::class,'make_comment'])->middleware('auth');



Route::get('/post_details/{post_id}',[postsController::class,'show']);
Route::get('/addLike/{post_id}',[postsController::class,'addLike'])->middleware('auth');


////search posts
//Route::get('/search',[postsController::class,'search_post']);


//sending real mail
Route::get('/send',[MailController::class,'index']);
