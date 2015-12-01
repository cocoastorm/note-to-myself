<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use Intervention\Image\Facades\Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notes;
use App\User;
use App\Picture;

use Session;

class NotesController extends Controller {
  public function index(){
      $user = Auth::user();
      $websites_array = explode(',', $user->websites);
      $picture = Picture::where('user_id', $user->id)->get();

      return View::make('notes')
          ->with('user',$user)
          ->with('sites',$websites_array)
          ->with('picture', $picture);
  }


  public function update($id, Request $request) {
    $note = User::find($id);
    $image_count = Picture::where('user_id', $id)->count();

    $check = Input::get('delete');
    if(!is_null($check)){
      for($i = 0; $i < count($check); $i++){
        $image_id = $check[$i];
        $image = Picture::where('user_id',$id)->where('id', $image_id);
        $image->delete();
      }
    }

    if($note) {
      $note->notes = Input::get('notes');
      $websites_array = Input::get('websites');
      $note->websites = implode(',', $websites_array);
      $note->tbd = Input::get('tbd');
      $note->save();
      if($request->hasFile('i')) {
        if($image_count < 4){
          $image = Input::file('i');
          $realImage = Image::make($image);
          $realImage->encode('jpg', 75);
          $picture = new Picture;
          $picture->user_id = $note->id;
          $picture->picture = $realImage;
          $picture->save();
        } else {
            Session::flash('error', "Maximum 4 Images!");
        }
      }

    }
    else {
      $note = new Notes;
      $note->userid = Auth::user()->id;
      $note->email = Auth::user()->email;
      $note->notes = Input::get('notes');
      $note->save();
    }
    return redirect()->back();
  }
}
