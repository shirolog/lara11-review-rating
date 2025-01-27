<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [

        'post_id',
        'user_id',
        'rating',
        'title',
        'description',
    ];

    // postテーブルとのリレーション関係

    public function post(){

        return $this->belongsTo(Post::class);
    }

    // userテーブルとのリレーション関係

    public function user(){

        return $this->belongsTo(User::class);
    }




}
