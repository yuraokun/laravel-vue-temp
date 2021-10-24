<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];



    // belongsToのmethod名はforegin_keyの名前にしないとその親テーブルと紐づかない
    public function author() {
        return $this->belongsTo('App\Models\Author');
    }
}