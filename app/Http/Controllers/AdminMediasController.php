<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

class AdminMediasController extends Controller
{
    public function index() {
    	//return 'this is the media view!'; //quick test
    	$photos = Photo::all();
    	return view('admin.media.index', compact('photos'));
    }

    public function store(Request $request) {
    	//return 'THIS IS THE STORE ON THE MEDIA CONTROLLER!'; //quick test
    	$file = $request->file('file'); //automatically from form get a 'file' type called 'file' accessed via post response

    	$name = time() .$file->getClientOriginalName(); //rename posted over image to a random name using current time attach

    	$file->move('images', $name); //move the new image name to public images folder

    	Photo::create(['file'=>$name]); //create the photo in database photo table
    }

    public function create() {
    	return view('admin.media.create');
    }

}
