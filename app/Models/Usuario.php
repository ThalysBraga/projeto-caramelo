<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $guarded = [];
    
    public function Animais()
    {
        return $this->hasMany(Animal::class, 'usuario_id');
    }
}
