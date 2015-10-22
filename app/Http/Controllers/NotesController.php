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
      $user = Auth::user();
      $notes = Notes::where('userid', $user->id)
        ->get();
    return view('notes', ['notes' => $notes]);
  }

  public function create(){
    return view('notes');
  }
  public function store(Request $request){
    $input = $request->all();
    Notes::create($input);
    return redirect()->back();
  }

  public function edit($id){
    return view('Notes.edit');
  }
}
