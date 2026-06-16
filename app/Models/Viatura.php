<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Viatura extends Model
{
    use HasFactory;

    protected $table = 'viaturas';

    protected $fillable = [
        'marca', 'modelo', 'matricula', 'ano', 'quilometros',
        'preco', 'foto', 'estado', 'combustivel', 'caixa', 'motor', 'descricao',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);


    }

    /**
 * Obtém as visitas associadas à viatura.
 */
public function visitas()
{
    return $this->hasMany(Visita::class);
}

}
