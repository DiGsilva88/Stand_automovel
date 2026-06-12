````markdown
# 🚗 Stand Automóvel – Sistema de Gestão de Viaturas

Aplicação web desenvolvida em **Laravel 12** para gestão de um stand automóvel, permitindo administrar viaturas, clientes e vendas através de uma interface intuitiva e organizada.

## 📖 Descrição

O projeto foi desenvolvido com o objetivo de centralizar a gestão de um concessionário automóvel, possibilitando:

- Gestão completa de viaturas;
- Registo e manutenção de clientes;
- Controlo de vendas;
- Acompanhamento de indicadores através de dashboard;
- Gestão automática do estado das viaturas (Disponível/Vendido).

---

## ✨ Funcionalidades

### 🚘 Gestão de Viaturas

- Registo de novas viaturas;
- Edição e remoção de viaturas;
- Upload de fotografias;
- Pesquisa por:
  - Marca;
  - Modelo;
  - Matrícula;
- Ordenação dinâmica;
- Paginação de resultados;
- Controlo de estado:
  - Disponível;
  - Vendido.

### 👤 Gestão de Clientes

- Registo de clientes;
- Consulta de dados;
- Atualização de informações;
- Validação de:
  - Email único;
  - NIF único;
  - Telefone.

### 💰 Gestão de Vendas

- Registo de vendas;
- Associação entre cliente e viatura;
- Atualização de vendas;
- Histórico de vendas;
- Alteração automática do estado da viatura após venda;
- Prevenção de venda duplicada de veículos já vendidos.

### 📊 Dashboard

Painel com indicadores em tempo real:

- Total de viaturas;
- Viaturas disponíveis;
- Viaturas vendidas;
- Total de clientes;
- Total de vendas;
- Valor total faturado;
- Últimas vendas registadas.

---

## 🛠 Tecnologias Utilizadas

- PHP 8.2+
- Laravel 12
- Blade Templates
- MySQL
- Bootstrap
- JavaScript
- Vite
- Composer
- NPM

---

## 📂 Estrutura do Projeto

```text
Stand_DianaSilva_2026/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php
│   │       ├── ViaturaController.php
│   │       ├── ClienteController.php
│   │       └── VendaController.php
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── fotos/
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
└── storage/
```

---

## 🗄 Modelo de Dados

### Viaturas

- Marca
- Modelo
- Matrícula
- Ano
- Quilómetros
- Preço
- Estado
- Fotografia

### Clientes

- Nome
- Email
- Telefone
- Endereço
- NIF

### Vendas

- Cliente
- Viatura
- Data da Venda
- Valor da Venda
- Observações

---

## ⚙️ Requisitos

Antes de iniciar o projeto, certifique-se de possuir:

- PHP >= 8.2
- Composer
- Node.js
- NPM
- MySQL ou MariaDB
- Laravel CLI (opcional)

---

## 🚀 Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/DiGsilva88/Stand_automovel.git
```

### 2. Entrar na pasta do projeto

```bash
cd Stand_DianaSilva_2026
```

### 3. Instalar dependências PHP

```bash
composer install
```

### 4. Instalar dependências JavaScript

```bash
npm install
```

### 5. Configurar ambiente

Copiar o ficheiro de exemplo:

```bash
cp .env.example .env
```

### 6. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 7. Configurar a base de dados

Editar o ficheiro `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stand_automovel
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Executar migrações

```bash
php artisan migrate
```

### 9. Compilar recursos frontend

```bash
npm run build
```

ou durante desenvolvimento:

```bash
npm run dev
```

### 10. Iniciar servidor

```bash
php artisan serve
```

A aplicação ficará disponível em:

```text
http://127.0.0.1:8000
```

---

## 🔀 Rotas Principais

| Método | URL | Descrição |
|----------|----------|----------|
| GET | /dashboard | Dashboard |
| GET | /viaturas | Listagem de viaturas |
| GET | /clientes | Listagem de clientes |
| GET | /vendas | Listagem de vendas |

O sistema utiliza Resource Controllers do Laravel para operações CRUD completas.

---

## 📊 Funcionalidades de Negócio

### Gestão Automática de Estado

Quando uma venda é registada:

- A viatura passa automaticamente para **Vendido**.

Quando uma venda é alterada:

- A viatura antiga volta a **Disponível**;
- A nova viatura passa para **Vendido**.

### Validações Implementadas

#### Viaturas

- Matrícula única;
- Ano válido;
- Preço positivo;
- Upload de imagem validado.

#### Clientes

- Email único;
- NIF único;
- Dados obrigatórios.

#### Vendas

- Cliente obrigatório;
- Viatura obrigatória;
- Valor positivo;
- Data válida.

---

## 📸 Capturas de Ecrã

### Dashboard

- Estatísticas gerais
- Últimas vendas

### Gestão de Viaturas

- Lista de veículos
- Pesquisa e ordenação

### Gestão de Clientes

- CRUD completo

### Gestão de Vendas

- Registo e histórico de vendas

---

## 🔒 Segurança

- Validação de formulários através do Laravel Validation;
- Proteção contra SQL Injection via Eloquent ORM;
- Proteção CSRF nativa do Laravel;
- Sanitização automática de inputs.

---

## 📈 Melhorias Futuras

- Sistema de autenticação de utilizadores;
- Perfis e permissões;
- Relatórios PDF;
- Exportação Excel;
- Pesquisa avançada;
- Integração com APIs automóveis;
- Dashboard com gráficos estatísticos;
- Gestão de financiamento automóvel.

---

## 👩‍💻 Autora

**Diana Silva**

Projeto académico desenvolvido no âmbito da formação em desenvolvimento web.

GitHub:

https://github.com/DiGsilva88

---

## 📄 Licença

Este projeto foi desenvolvido para fins académicos e educativos.

Todos os direitos reservados à autora.
````
