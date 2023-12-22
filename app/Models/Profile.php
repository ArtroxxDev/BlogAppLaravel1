<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //establecemos la relacion inversa one to one con user
    /**
     * Para hacer eso utilizamos la funcion llamada "BelongsTo
     * el método belongsTo se utiliza para establecer relaciones entre modelos, indicando que un registro en una tabla "pertenece" a otro registro en otra tabla.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
