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

Route::get('/myplaylists', 'HomeController@myPlaylists')->name('showMyPlaylists');
Route::get('/playlistliked', 'HomeController@playlistLiked');
Route::get('/playlist_un_liked', 'HomeController@playlistUnLiked');
Route::post('/playlistcommented', 'PlaylistController@addComment');


