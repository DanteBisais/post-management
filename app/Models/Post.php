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
        return $this->belongsToMany('App\Models\Category', 'category_post', 'post_id','category_id');
    }

    public function postCategory()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');

    }


//
//     public function roles()
//     {
//         return $this->belongsToMany('App\Models\Role');
//     }

//     /**
//      * Check if the user has a role
//      * @param string $role
//      * @return bool
//      */
//     public function hasAnyRole(string $role)
//     {
//         return null !== $this->roles()->where('name', $role)->first();
//     }
//
//     /**
//      * Check the user has any given role
//      * @param array $role
//      * @return bool
//      */
//     public function hasAnyRoles(array $role)
//     {
//         return null !== $this->roles()->whereIn('name', $role)->first();
//     }
}
