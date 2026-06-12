<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
     use HasFactory; // Adicionar esta linha

    protected $fillable = ['nome', 'email', 'telemovel', 'nif'];
    

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
