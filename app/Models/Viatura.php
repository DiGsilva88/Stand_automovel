<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Viatura extends Model
{
    use HasFactory;

    protected $table = 'viaturas';

    protected $fillable = [
        'marca', 'modelo', 'matricula', 'ano', 'quilometros', 'preco', 'foto', 'estado'
    ];

    public function venda()
    {
        return $this->hasOne(Venda::class);
    }
}
