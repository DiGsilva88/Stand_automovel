<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Viatura; // Importação da Viatura

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * Verifica se o utilizador é administrador.
     */
    public function isAdmin(): bool
    {
        // Validação segura por e-mail ou pelo campo de permissão 'admin'
    return $this->email === 'admin@ssautomoveis.pt' || $this->role === 'admin';
    }

    /**
     * Relacionamento dos Favoritos da Garagem
     */
    public function favorites()
    {
        return $this->belongsToMany(Viatura::class, 'favoritos', 'user_id', 'viatura_id');
    }

    /**
     * Obter as marcações feitas por este utilizador baseando-se no nome registado.
     */
    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'nome_cliente', 'name');
    }
}
