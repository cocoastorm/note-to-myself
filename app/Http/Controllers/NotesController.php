<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\Notes;
use App\User;
use Auth;

class NotesController extends Controller {
  public function index(){
      $user = Auth::user();
      $notes = Notes::where('userid', $user->id)
        ->get();
    return view('notes', ['notes' => $notes]);
  }

  public function create(){
    return view('notes');
  }
  public function store(Request $request) {
      // validate
      $rules = array(
        'userid'       => 'required',
        'email'       => 'required'
      );
      $validator = Validator::make(Input::all(), $rules);

      // process
      if($validator->fails()) {
          return Redirect::to('students/create')
              ->withErrors($validator)
              ->withInput();
      }
      else {
        $note = new Note;
        $note->userid = Input::get('userid'); // no idea how to get this from auth->user yet
        $note->email = Input::get('email'); // wtf is this?
        $note->notes = Input::get('notes');
        $note->websites = Input::get('websites');
        $note->tbd = Input::get('tbd');

        // store back to database
        $note->save();

        // redirect back
        return redirect()->back();
    }
  }

  public function edit($id){
    return view('Notes.edit');
  }
}
