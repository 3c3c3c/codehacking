<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CommentReply;

use Auth;

use App\Comment;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comment.replies.index');
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
        //
    }

    public function createReply(Request $request) {
        //return 'it wurks!'; //quich test
        $user = Auth::user(); //grab user details
        //return $user->photo->file; //test to see if image being sent 
        $data = [
            'comment_id' => $request->comment_id,
            'author'  => $user->name,
            'email'   => $user->email,
            'photo'   => $user->photo->file,
            'body'    => $request->body
        ];
        CommentReply::create($data); //grab posted request details

        $request->session()->flash('comment_reply_message', 'Comment reply submitted succcessfully and awaiting moderation! Thank you');

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
        //return 'id wurks!'; //quick test
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show', compact('replies'));
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
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentReply::findOrFail($id)->delete();
        return redirect()->back();
    }
}
