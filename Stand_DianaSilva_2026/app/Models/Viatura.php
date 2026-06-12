<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Viatura extends Model
{
    use HasFactory; // Adicionar esta linha
    protected $table = 'viaturas';

    protected $fillable = [
        'marca', 'modelo', 'ano', 'preco', 'descricao'
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class); // Relacionamento com a tabela de vendas
    }
}
