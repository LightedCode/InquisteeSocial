<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps=true;
    protected $fillable=['category'];


    //all games books movies and sports have many user who like
    //them and they are liked by many


    public function like(){
        return $this->belongsToMany('App\Models\Like','likes_movies','movies_id','likes_id');
    }
}
