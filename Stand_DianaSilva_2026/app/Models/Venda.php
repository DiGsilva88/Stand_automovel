<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Adicionar esta linha
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory; // Adicionar esta linha

    protected $fillable = ['cliente_id', 'viatura_id', 'data_venda', 'valor_venda', 'observacoes'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function viatura()
    {
        return $this->belongsTo(Viatura::class);
    }
}
