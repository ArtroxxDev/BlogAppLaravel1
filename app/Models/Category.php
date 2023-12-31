<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //definicion de relacion uno a muchos con article
    public function articles(){
        return $this->hasMany(Article::class);
    }

    //utilizamos el slug en lugar del id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
