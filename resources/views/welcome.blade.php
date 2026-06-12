<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SS Automóveis</title>

    <!-- Link do Bootstrap 5 oficial e completo -->
    <link href="https://jsdelivr.net" rel="stylesheet" crossorigin="anonymous">

    <style>
        /* Forçar ecrã total sem barras de rolagem */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #000000;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            overflow: hidden;
        }

        .hero-section {
            background-image: url("{{ asset('fotos/fachada-stand.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        /* Máscara escura estruturada para centralização matemática vertical e horizontal */
        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.75);
            width: 100%;
            height: 100%;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Caixa de conteúdo central */
        .content-box {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 600px; /* Garante que os textos não quebram de forma estranha */
            padding: 20px;
        }

        /* Logótipo Gráfico */
        .brand-logoimg {
            height: 180px;
            width: auto;
            object-fit: contain;
            margin-bottom: 1rem;
            display: block;
        }

        /* Subtítulo */
        .brand-subtitle {
            font-size: 2rem;
            letter-spacing: 12px;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 300;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }

        /* Slogan Principal */
        .Brand-Tagline {
            font-size: 1rem;
            letter-spacing: 5px;
            color: #CCCCCC;
            font-weight: 300;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        /* Linha de Tempo (Dourada) */
        .brand-timeline {
            font-size: 0.8rem;
            letter-spacing: 3px;
            color: #D4AF37;
            font-weight: 400;
            text-transform: uppercase;
        }

        /* Botão Redondo com Alinhamento Forçado */
        .btn-premium {
            background-color: transparent;
            color: #ffffff !important;
            border: 1.5px solid #ffffff;
            padding: 14px 65px;
            font-size: 0.95rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.4s ease-in-out;
            text-decoration: none;

            /* Forçar comportamento de bloco centrado */
            display: inline-block;
            margin: 3rem auto 0 auto; /* Centraliza horizontalmente através de margens */
            width: fit-content;       /* Impede que o botão estique para os lados */
        }

        .btn-premium:hover {
            background-color: #ffffff;
            color: #000000 !important;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
            transform: scale(1.03);
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-overlay">

            <!-- Contentor focado em garantir a simetria de todos os elementos -->
            <div class="content-box">

                <!-- Logótipo Oficial SS -->
                <img src="{{ asset('fotos/logo2.png') }}" alt="SS Logótipo" class="brand-logoimg mx-auto">

                <div class="brand-subtitle">Automóveis</div>

                <!-- Slogans Informativos -->
                <div class="Brand-Tagline">Excelência em cada curva</div>
                <div class="brand-timeline">Desde 2026, redefinindo o luxo automóvel</div>

                <!-- Botão de Entrada Centrado -->
                <a href="{{ route('dashboard') }}" class="btn-premium">
                    Entrar
                </a>

            </div>

        </div>
    </div>

</body>
</html>
