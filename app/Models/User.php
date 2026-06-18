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
        'name', 'email', 'password', 'is_admin', // ou 'role'
    ];

    // ... Outros métodos como o seu es_admin ...

    /**
     * Relacionamento dos Favoritos da Garagem
     */
     public function favorites()
    {
        // Força o Laravel a usar a tabela 'favoritos' e os nomes de coluna padrão
        return $this->belongsToMany(Viatura::class, 'favoritos', 'user_id', 'viatura_id');
    }

       /**
     * Obter as marcações feitas por este utilizador baseando-se no nome registado.
     */
    public function visitas()
    {
        // Como não tem user_id, filtramos as visitas cujo 'nome_cliente' seja igual ao 'name' do utilizador
        return $this->hasMany(\App\Models\Visita::class, 'nome_cliente', 'name');
    }
}
