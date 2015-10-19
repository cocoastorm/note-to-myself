<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\Notes;
use App\User;
use Auth;

class NotesController extends Controller{
    public function index(){
    return View::make('welcome',['notes'=>Notes::all()]);
}

public function logout(){
    $user = Auth::user();
      return View::make('logout',['email'=>$user]);
}


public function create(){
  return view('welcome');
}
public function store(Request $request){
  $input = $request->all();
  Notes::create($input);
  return redirect()->back();
}

public function edit($id){
  return view('Notes.edit');
}

/*public function logout(){
      return View::make('logout', ['email'=>"Jondeluz@hotmail.com"]);
 }
*/
}
