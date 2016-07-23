<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Posts;

use App\Http\Requests\PostsCreateRequest;

use Illuminate\Support\Facades\Session;

use Auth;

use App\Photo;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request) //note the hooking up of form validation by using the request
    {
        //return $request->all();
        $user = Auth::user();   //grab the logged in user NB  NB  NB  NB NOTE THE use Auth; at top
        $input = $request->all(); //grab the posted over data
        if($file = $request->file('photo_id')) {   //check if a photo file posted over
            //return 'photo file posted over!'; //quick test
            $name = time() .$file->getClientOriginalName(); //append time in seconds to file name ie. make unique
            $file->move('images', $name); //move photo file to public images folder and create such folder if not there
            $photo = Photo::create(['file'=>$name]); //create a photo in database with file name
            $input['photo_id'] = $photo->id; //assign the id of this photo to the posted over data
        }
        $user->posts()->create($input); //create the user post while making the relationship
        return redirect('/admin/posts');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
