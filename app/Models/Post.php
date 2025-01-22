<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [

        'title',
        'image',
    ];

    //reviewsテーブルとのリレーション関係

    public function reviews(){

        return $this->hasMany(Review::class);
    }

    //レビュー数をカウントする属性を定義
    protected $appends = ['reviews_count'];

    public function getReviewsAttribute(){

        return $this->reviews()->count();
    }
}
