<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //definicion de relacion muchos a uno con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //definicion de relacion muchos a uno con article
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
