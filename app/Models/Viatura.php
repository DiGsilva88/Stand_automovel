<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{
    protected $fillable = [
      'marca', 'modelo', 'matricula', 'ano',
        'quilometros', 'preco', 'foto', 'estado'
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class); // Relacionamento com a tabela de vendas
    }
}
