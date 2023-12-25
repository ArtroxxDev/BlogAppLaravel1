<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //definicion de relacion muchos a uno con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //definicion de relacion uno a muchos con comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //definicion de relacion muchos a uno con category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
