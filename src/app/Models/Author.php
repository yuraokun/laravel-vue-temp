<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }


   
    static function boot() {
        parent::boot();
         // Authorの削除の際にリレーションでつながっているテーブルの列を先に削除
        static::deleting(function(Author $author) {
            //  dd('i was deleted');
            $author->posts()->delete();
        });
        
         // Authorの復元の際にリレーションでつながっているテーブルの列を先に復元
        static::restored(function(Author $author) {
            //  dd('i was restored');
            $author->posts()->restore();
        });

        //Authorの復元の際にリレーションでつながっているテーブルの列を先に復元
        static::restoring(function(Author $author) {
            //  dd('i was restored');
            $author->posts()->restore();
        });
    }
}


// Author::withCount(['posts', 'posts as new_comments' => function($query) {
//      $query->where('created_at', '>=', '2021-10-23 06:13:57');
// }])->get();