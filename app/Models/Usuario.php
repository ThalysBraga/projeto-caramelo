<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model implements Authenticatable
{
    use HasApiTokens;

    use HasFactory;

    protected $table = 'usuarios';
    protected $guarded = [];
    
    public function Animais()
    {
        return $this->hasMany(Animal::class, 'usuario_id');
    }

    
    /*****
     * Início dos métodos relacionados à interface Authenticatable
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return uniqid();
    }

    public function getRememberToken()
    {
        return '';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return '';
    }
    /*
     * Fim dos métodos relacionados à interface Authenticatable
     *****/
}
