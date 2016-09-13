<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Posts extends Model 
{
    
    protected $sluggable = [ 'build_from' => 'title', 'save_to' => 'slug', 'on_update' => true ];
    protected $fillable = [
    	'user_id',
    	'category_id',
    	'photo_id',
    	'title',
    	'body'
    ];

    //each post can belong to a user see corresponding in user where each user can have many posts
    public function user() {
    	return $this->belongsTo('App\User');
    }

    //each post can have a photo
    public function photo(){
    	return $this->belongsTo('App\Photo'); //belongsTo ~ has one
    }

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    //a post has many comments
    public function comments() {
        return $this->hasMany('App\Comment', 'post_id');
    }


}

