<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    	protected $fillable = [
		'comment_id',
		'author',
		'email',
		'photo',
		'body',
		'is_active'
	];

	//a comment reply belongs to a comment
	public function comment() {
		return $this->belongsTo('App\Comment');
	}
}
