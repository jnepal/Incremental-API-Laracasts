<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";

    protected $fillable = [
        'title',
        'body'
    ];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
