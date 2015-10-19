<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/all', function () {
  $notes = \App\Notes::all();
    return $notes;
});

Route::get('/insert', function(){
  DB::insert('insert into notes(id, email, notes, websites, tbd) values(?,?,?,?,?)', [null, "123@123.com", "stuff n things", "google.ca", "tbdddd"]);

});

Route::get('/update', function(){
  $note = \App\Notes::find(1);
  $note->email='itzfatalshot@hotmail.com';
  $note->save();
  return \App\Notes::find(1);
});
*/

Route::get('/welcome', 'NotesController@index');

Route::get('edit', function(){
  return view('edit');
});

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/logout', 'NotesController@logout');

Route::get('home',function(){
  if(Auth::guest()){
    return Redirect::to('auth/login');
  }
  else {
    return view('notes');
}
});

Route::resource('notes', 'NotesController');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
