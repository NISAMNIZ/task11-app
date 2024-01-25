<?php

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
Route::get('/','LoginController@login')->name('login.book');
Route::post('dologin','LoginController@dologin')->name('dologin.book');

Route::group(['middleware'=>'user_auth'],function(){
Route::get('/reg', 'BookController@DoReg')->name('register.book');
Route::post('regsave', 'BookController@DoRegSave')->name('regsave.book');
Route::get('home','BookController@home')->name('home.book');
Route::get('search','BookController@search')->name('search.book');
Route::post('/subscribe','BookController@store')->name('store.book');
Route::get('count', 'BookController@count')->name('count.book');
Route::get('/logout','LoginController@logout')->name('logout');
});