<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\userController;
use App\Models\users;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteUri;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [homeController::class,'index'])->name('home');

Route::get('product',[homeController::class,'products'])->name('product');

Route::get('add-product',[homeController::class,'getAdd']);

Route::post('add-product',[homeController::class,'postAdd'])->name('post-add');

Route::get('response', function(){
    $response = (new Response())->cookie('laravel','hoc lap trinh laravel',30);
    return $response;
});

Route::get('response2', function(Request $request){
    
    return $request->cookie('laravel');
});

Route::get('download-image',[homeController::class,'downloadImage'])->name('download-image');

Route::prefix('users')->name('users.')->group(function(){
    Route::get('/',[userController::class,'index'])->name('index');

    Route::get('/add',[userController::class,'add'])->name('add');

    Route::post('/add',[userController::class,'postAdd'])->name('post-Add');

    Route::get('/edit/{id}',[userController::class,'getEdit'])->name('edit');
    
    Route::post('/update',[userController::class,'postEdit'])->name('post-Edit');

    Route::get('/delete/{id}',[userController::class,'getDelete'])->name('delete');
});
Route::get('learn',[userController::class,'getQuery']);