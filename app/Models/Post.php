<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body'
    ];

    // public function post(){
    //     return $this->belongsToMany(Category::class);

    // }
    function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    // function posts(){
    //     return $this->belongsToMany('App\Category');
    // }

    // public function getPostCategory(){
    //     return $this->belongsToMany('App\Model\Category', 'post_category', 'post_id', 'id');
    // }
}