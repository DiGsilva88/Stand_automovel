<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'cliente_id', 'viatura_id', 'data_venda', 'preco_venda','observacoes'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function viatura()
    {
        return $this->belongsTo(Viatura::class);
        // Relacionamento com a tabela de viaturas,O uso de hasOne (Viatura→Venda) em vez de hasMany garante que uma viatura só pode ter uma venda.
        
    }
}
