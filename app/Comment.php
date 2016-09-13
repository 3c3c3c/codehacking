<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Posts;

class Comment extends Model
{
	protected $fillable = [
		'post_id',
		'author',
		'email',
		'photo',
		'body',
		'is_active'
	];
    
	//a comment has many replies
    public function replies() {
    	return $this->hasMany('App\CommentReply');
    }

    //a comment has a post
    public function post() {
    	return $this->belongsTo('App\Posts');
    }


}
