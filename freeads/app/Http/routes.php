<?php
/**
*PHP version 5
*File doc comment
*@category Sniffer
*@package  Sniffer.Test
*@author   ANTON Maicmelan <maicmelan.anton@epitech.eu>
*@license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
*@link     http://intra.epitech.eu
*/
Route::get('/', 'IndexController@showIndex');

Route::get('/login', 'UsersController@index');

Route::get('/inscription', 'UsersController@Utilisateur');

Route::get('/accueil', 'AnnoncesController@accueil');

Route::get('/profil', 'UsersController@profil');

Route::get('/password', 'UsersController@password');

Route::post('/password', 'UsersController@passwordChange');

Route::post('/accueil', 'AnnoncesController@recherche');

Route::post('/profil', 'UsersController@profilUpDate');

Route::post('/inscription', 'UsersController@create');

Route::get('/logout', 'UsersController@logout');

Route::get('/upload', 'AnnoncesController@upload');

Route::get('/published', 'AnnoncesController@published');

Route::get('/delete', 'AnnoncesController@delete');

Route::get('/edit', 'AnnoncesController@edit');

Route::get('/message', 'MessagesController@index');

Route::get('/received', 'MessagesController@received');

Route::get('/sended', 'MessagesController@sended');

Route::get('/msg', 'MessagesController@msg');

Route::post('/msg', 'MessagesController@sendMsg');

Route::post('/edit', 'AnnoncesController@editController');

Route::post('/upload', 'AnnoncesController@uploadControlle');

Route::get('/view', 'AnnoncesController@view');

Route::post('/login', 'UsersController@login');