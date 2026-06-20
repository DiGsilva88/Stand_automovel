<div align="center">

# 🏎️ SS Automóveis

### Plataforma Web de Gestão de Stand Automóvel

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Showroom digital, gestão de inventário e painel administrativo para um stand automóvel premium.

[Sobre](#-sobre-o-projeto) · [Funcionalidades](#-funcionalidades) · [Stack](#-stack-tecnológico) · [Instalação](#-instalação) · [Estrutura da BD](#-estrutura-da-base-de-dados) · [Screenshots](#-screenshots)

</div>

---

## 📖 Sobre o Projeto

A **SS Automóveis** é uma aplicação web full-stack desenvolvida em Laravel para a gestão completa de um stand de comercialização de veículos novos e usados. O projeto combina um **showroom público** orientado à conversão de visitantes em clientes, com um **back-office administrativo** completo para gestão de inventário, clientes e vendas.

O sistema distingue dois perfis de utilizador — **Administrador** e **Cliente** — cada um com vistas e permissões dedicadas, partilhando a mesma rota de dashboard mas apresentando experiências completamente distintas conforme o perfil autenticado.

---

## ✨ Funcionalidades

### 🌐 Área Pública
- **Página inicial** com hero institucional, marcas em destaque e carrossel de viaturas
- **Showroom** com pesquisa e filtros por marca, combustível e preço máximo (slider interativo)
- **Paginação** com preservação dos parâmetros de pesquisa
- **Formulário de marcação de Test Drive / Visita**, com seleção de viatura, dados de contacto, data e hora

### 👤 Área do Cliente — *"A Minha Garagem"*
- Saudação personalizada e indicadores rápidos (carros guardados, pedidos ativos)
- Galeria de **modelos de eleição** (viaturas marcadas como favoritas)
- Acompanhamento de **negociações e propostas** em curso
- Lista de **visitas agendadas** ao stand

### 🛠️ Painel Administrativo — *"Performance Overview"*
- **KPIs em tempo real**: faturação total, stock disponível, clientes registados, vendas concluídas
- **Gráfico de performance de vendas** (Chart.js) com evolução mensal da faturação
- **Inventário recente** com ações rápidas de edição e remoção
- **Performance comercial / Top Vendedores** com ranking por viaturas entregues
- **Gestão de Clientes** — criação e consulta de fichas (nome, contacto, NIF)
- **Gestão de Vendas** — registo de contratos associando viatura, cliente, data e valor
- **Gestão de Viaturas (CRUD)** — criação, edição, remoção e upload de fotografia
- **Gestão de Visitas** — confirmação ou cancelamento de pedidos de test drive

### 🔐 Autenticação e Permissões
- Registo e login via **Laravel Breeze**
- Controlo de acesso baseado em perfil (`role`: `admin` / `cliente`) através do método `isAdmin()` no model `User`
- Middleware dedicado a proteger rotas administrativas sensíveis

---

## 🧰 Stack Tecnológico

| Camada | Tecnologia |
|---|---|
| Backend | [Laravel 12](https://laravel.com) · PHP 8.2 |
| Base de Dados | MySQL |
| Frontend | Blade Templates · [Tailwind CSS](https://tailwindcss.com) |
| Gráficos | [Chart.js](https://www.chartjs.org) |
| Autenticação | Laravel Breeze |
| Ambiente de Desenvolvimento | Laragon / XAMPP |

---

## 🚀 Instalação

### Pré-requisitos
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### Passos

```bash
# 1. Clonar o repositório
git clone https://github.com/<utilizador>/ss-automoveis.git
cd ss-automoveis

# 2. Instalar dependências PHP
composer install

# 3. Instalar dependências JS
npm install

# 4. Configurar ambiente
cp .env.example .env
php artisan key:generate
```

Edita o `.env` com as credenciais da tua base de dados local:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stand_dianasilva_2026
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 5. Correr as migrations
php artisan migrate

# 6. Criar o link simbólico de storage (uploads de fotos)
php artisan storage:link

# 7. Compilar assets
npm run build

# 8. Arrancar o servidor local
php artisan serve
```

A aplicação fica disponível em **http://127.0.0.1:8000**.

> ⚠️ **Nota:** o repositório não inclui a base de dados. Em cada novo ambiente é necessário correr as migrations e popular o inventário manualmente, ou através de um seeder, antes do showroom apresentar viaturas.

---

## 🗄️ Estrutura da Base de Dados

| Tabela | Descrição |
|---|---|
| `users` | Utilizadores da plataforma, com o campo `role` (`admin` / `cliente`) |
| `viaturas` | Catálogo de veículos: marca, modelo, matrícula, ano, km, combustível, preço, foto, estado |
| `clientes` | Fichas de clientes (nome, contacto, NIF), distintas da conta de utilizador |
| `vendas` | Histórico de transações, associando viatura, cliente, data e valor |
| `agendamentos` | Pedidos de visita / test drive (mapeados pelo model `Visita`) |
| `favoritos` | Tabela pivot N:N entre `users` e `viaturas`, suporta a Garagem do cliente |

---

## 📁 Estrutura de Rotas

```
routes/web.php
├── Rotas Públicas
│   ├── GET  /                      → Página inicial
│   ├── GET  /viaturas               → Showroom
│   ├── GET  /marcar-visita          → Formulário de agendamento
│   └── POST /marcar-visita          → Submissão do agendamento
│
├── Rotas Autenticadas (auth + verified)
│   ├── GET  /dashboard              → Dashboard (vista por perfil)
│   ├── POST /viaturas/{id}/favorito → Toggle de favorito
│   └── ...  /profile                → Gestão de perfil (Breeze)
│
└── Rotas Administrativas (middleware: admin)
    ├── /clientes                    → CRUD de clientes
    ├── /vendas                      → CRUD de vendas
    ├── /viaturas/{id}/editar        → Edição de viaturas
    └── /admin/visitas/{id}/...      → Confirmar / cancelar agendamentos
```

---

## 📸 Screenshots

<details open>
<summary><strong>Página Inicial</strong></summary>
<br>
<img src="screenshots/01-homepage.png" alt="Página inicial com hero, marcas e viaturas em destaque">
</details>

<details>
<summary><strong>Showroom</strong></summary>
<br>
<img src="screenshots/02-showroom.png" alt="Grelha do showroom com filtros e cartões de viaturas">
</details>

<details>
<summary><strong>Agendamento de Test Drive</strong></summary>
<br>
<img src="screenshots/03-agendar-visita.png" alt="Formulário de marcação de test drive">
</details>

<details>
<summary><strong>Área do Cliente — A Minha Garagem</strong></summary>
<br>
<img src="screenshots/04-minha-garagem.png" alt="Dashboard do cliente com favoritos e propostas">
</details>

<details>
<summary><strong>Painel Administrativo — Performance Overview</strong></summary>
<br>
<img src="screenshots/05-dashboard-admin.png" alt="Dashboard administrativo com KPIs e gráfico de vendas">
</details>

<details>
<summary><strong>Gestão de Clientes</strong></summary>
<br>
<img src="screenshots/06-novo-cliente.png" alt="Formulário de criação de novo cliente">
</details>

<details>
<summary><strong>Gestão de Vendas</strong></summary>
<br>
<img src="screenshots/07-nova-venda.png" alt="Formulário de registo de nova venda">
<img src="screenshots/08-vendas.png" alt="Listagem do histórico de vendas">
</details>

---

## 🔮 Trabalho Futuro

- [ ] Integração de meios de pagamento para reserva direta de viaturas
- [ ] Geração automática de propostas comerciais / contratos em PDF
- [ ] Notificações por email sobre o estado de marcações e propostas
- [ ] Seeder de dados de demonstração para facilitar novos ambientes de desenvolvimento

---

## 📄 Licença

Este projeto encontra-se disponível sob a licença MIT. Consulta o ficheiro [LICENSE](LICENSE) para mais detalhes.

---

<div align="center">

Desenvolvido por **Diana Silva** · SS Automóveis © 2026

</div>
