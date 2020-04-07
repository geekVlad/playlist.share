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
Route::get('/playlist/{id}', 'PlaylistController@ShowPlaylist')->name('showplaylist');
Route::get('/user/{id}', 'HomeController@showUserPlaylists');

Route::get('/myplaylists', 'HomeController@myPlaylists')->name('showMyPlaylists');
Route::get('/newplaylists/{id?}', 'HomeController@showNewPlaylists');
Route::get('/myfollows', 'HomeController@myFollows');
Route::get('/artists', 'HomeController@showArtists');
Route::get('/artist/{id}', 'HomeController@showArtist');
Route::get('/album/{id}', 'HomeController@showAlbum');
Route::get('/albums', 'HomeController@showAlbums');

Route::get('/playlistliked/{id}', 'HomeController@playlistLiked');
Route::get('/playlist_unliked/{id}', 'HomeController@playlistUnliked');

Route::post('/playlistcommented/{id}', 'PlaylistController@addComment');
Route::post('/commentreplied/{id}', 'PlaylistController@addCommentReply');
Route::get('/commentdeleted/{id}', 'PlaylistController@deleteComment');

Route::post('/search', 'PlaylistController@search');

Route::get('/playlistfollowed/{id}', 'HomeController@playlistFollowed');
Route::get('/playlist_unfollowed/{id}', 'HomeController@playlistUnfollowed');

Route::get('/addexistingsong/playlist/{playlist_id}/song/{song_id}', 'PlaylistController@addExistingSong');
