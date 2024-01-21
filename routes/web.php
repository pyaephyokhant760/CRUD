<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


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

//

Route::get('cutomerPage',[CustomerController::class,'create'])->name('customer#page');
Route::post('createPost',[CustomerController::class,'createPost'])->name('create#post');

// Route::get('create/delete/{id}',[CustomerController::class,'createDelete'])->name('create#delete');
Route::delete('create/delete/{id}',[CustomerController::class,'createDelete'])->name('create#delete');

Route::get('create/update/{id}',[CustomerController::class,'createUpdate'])->name('create#update');
Route::get('create/edit/{id}',[CustomerController::class,'createEdit'])->name('create#edit');
Route::post('create/update/data',[CustomerController::class,'createData'])->name('create#update#data');

