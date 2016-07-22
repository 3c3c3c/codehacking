<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $uploads = '/images/';  //used as part of the directory path for photos so as not to hard code in the view.
    protected $fillable = [ 'file'];

    //accessor to get a photo note column in photo table is called 'file'
    public function getFileAttribute($photo) {
    	return $this->uploads .$photo;  //concatenates the public images directory with the photo as a path to the photo
    }
}
