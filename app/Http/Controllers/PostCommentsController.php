<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use Auth;

use App\Posts;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all(); //gets all comments from comments table
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //NOTE ONLY USERS LOGGED INTO THE APPLICATION CAN COMMENT
        //return 'yep comment create wurking'; //quick test
        // $comment = $request->body;
        //return $comment; //quick test
        //return $request->all(); //quick test
        $user = Auth::user(); //grab user details
        //return $user->photo->file; //test to see if image being sent 
        $data = [
            'post_id' => $request->post_id,
            'author'  => $user->name,
            'email'   => $user->email,
            'photo'   => $user->photo->file,
            'body'    => $request->body
        ];
        Comment::create($data); //grab posted request details

        $request->session()->flash('comment_message', 'Comment submitted succcessfully and awaiting moderation! Thank you');

        return redirect()->back(); //returns to same page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Comment::findOrFail($id)->update($request->all()); //find the comment by id and update to posted in details
        return redirect()->back(); //go back to refreshed  list of comments 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }
}
