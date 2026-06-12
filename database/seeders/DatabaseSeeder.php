<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===================== CLIENTES =====================
        $clientes = [
            ['nome' => 'João Silva',     'email' => 'joao.silva@email.pt',     'telefone' => '912345678', 'morada' => 'Rua das Flores, 12, Lisboa',  'nif' => '123456789'],
            ['nome' => 'Maria Santos',   'email' => 'maria.santos@email.pt',   'telefone' => '923456789', 'morada' => 'Av. da Liberdade, 45, Porto', 'nif' => '234567890'],
            ['nome' => 'Pedro Costa',    'email' => 'pedro.costa@email.pt',    'telefone' => '934567890', 'morada' => 'Rua Central, 8, Braga',       'nif' => '345678901'],
            ['nome' => 'Ana Ferreira',   'email' => 'ana.ferreira@email.pt',   'telefone' => '945678901', 'morada' => 'Largo do Mercado, 3, Faro',   'nif' => '456789012'],
            ['nome' => 'Rui Oliveira',   'email' => 'rui.oliveira@email.pt',   'telefone' => '956789012', 'morada' => 'Travessa Nova, 21, Coimbra',  'nif' => '567890123'],
        ];

        foreach ($clientes as $c) {
            Cliente::create($c);
        }

        // ===================== VIATURAS =====================
        $viaturas = [
            ['marca' => 'Mercedes-Benz', 'modelo' => 'A200 d',   'matricula' => 'AA-00-XX', 'ano' => 2021, 'quilometros' => 45000, 'preco' => 29900.00, 'foto' => null, 'estado' => 'Disponível'],
            ['marca' => 'BMW',           'modelo' => '116d',     'matricula' => '99-ZZ-11', 'ano' => 2019, 'quilometros' => 85000, 'preco' => 19500.00, 'foto' => null, 'estado' => 'Disponível'],
            ['marca' => 'Toyota',        'modelo' => 'Corolla',  'matricula' => 'AB-12-CD', 'ano' => 2020, 'quilometros' => 52000, 'preco' => 18500.00, 'foto' => null, 'estado' => 'Disponível'],
            ['marca' => 'Volkswagen',    'modelo' => 'Golf',     'matricula' => 'CD-34-EF', 'ano' => 2019, 'quilometros' => 67000, 'preco' => 16200.00, 'foto' => null, 'estado' => 'Disponível'],
            ['marca' => 'Renault',       'modelo' => 'Clio',     'matricula' => 'EF-56-GH', 'ano' => 2018, 'quilometros' => 92000, 'preco' => 9800.00,  'foto' => null, 'estado' => 'Vendido'],
            ['marca' => 'Audi',          'modelo' => 'A3',       'matricula' => 'GH-78-IJ', 'ano' => 2022, 'quilometros' => 18000, 'preco' => 27500.00, 'foto' => null, 'estado' => 'Vendido'],
            ['marca' => 'Peugeot',       'modelo' => '208',      'matricula' => 'IJ-90-KL', 'ano' => 2021, 'quilometros' => 31000, 'preco' => 15200.00, 'foto' => null, 'estado' => 'Disponível'],
            ['marca' => 'Seat',          'modelo' => 'Ibiza',    'matricula' => 'KL-12-MN', 'ano' => 2020, 'quilometros' => 48000, 'preco' => 13900.00, 'foto' => null, 'estado' => 'Disponível'],
        ];

        foreach ($viaturas as $v) {
            Viatura::create($v);
        }

        // ===================== VENDAS =====================
        // Associa as viaturas com estado "Vendido" a clientes existentes
        $renault = Viatura::where('matricula', 'EF-56-GH')->first();
        $audi    = Viatura::where('matricula', 'GH-78-IJ')->first();

        $clienteJoao  = Cliente::where('email', 'joao.silva@email.pt')->first();
        $clienteMaria = Cliente::where('email', 'maria.santos@email.pt')->first();

        Venda::create([
            'cliente_id'  => $clienteJoao->id,
            'viatura_id'  => $renault->id,
            'data_venda'  => '2026-03-15',
            'valor_venda' => 9500.00,
            'observacoes' => 'Pagamento em duas tranches. Cliente satisfeito.',
        ]);

        Venda::create([
            'cliente_id'  => $clienteMaria->id,
            'viatura_id'  => $audi->id,
            'data_venda'  => '2026-05-02',
            'valor_venda' => 27000.00,
            'observacoes' => 'Inclui garantia adicional de 1 ano.',
        ]);
    }
}
