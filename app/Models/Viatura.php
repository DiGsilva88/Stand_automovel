<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{
    use HasFactory;

    // Define o nome correto da tabela caso não seja o plural padrão
    protected $table = 'viaturas';

    // Campos autorizados para gravação em massa (Sincronizados)
    protected $fillable = [
        'marca', 
        'modelo', 
        'ano', 
        'quilometros', 
        'preco', 
        'estado', 
        'foto', 
        'matricula',
        'combustivel'
    ];

    /**
     * Relação inversa com as Vendas.
     */
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'viatura_id');
    }

    /**
     * Relação inversa com os utilizadores que favoritaram este carro.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favoritos', 'viatura_id', 'user_id');
    }
}
