<?php

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



Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/addplaylist', 'PlaylistController@AddPlaylistGet')->name('addplaylistget');
Route::post('/addplaylist', 'PlaylistController@AddPlaylistPost')->name('addplaylistpost');
Route::get('/playlist', 'PlaylistController@ShowPlaylist')->name('showplaylist');


