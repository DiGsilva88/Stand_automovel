<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SS Automóveis</title>

    <!-- Forçar o carregamento do Bootstrap 5 através de CDN Independente -->
    <link href="https://jsdelivr.net" rel="stylesheet" crossorigin="anonymous">

    <style>
        /* Reset total para garantir que ocupa todo o ecrã */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #000000;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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

        /* Máscara escura uniforme */
        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.75);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilo das Letras SS */
        .brand-title {
            font-size: 6rem;
            font-weight: 700;
            letter-spacing: 15px;
            color: #ffffff;
            margin-bottom: 0;
            line-height: 1;
        }

        /* Estilo do Subtítulo Automóveis */
        .brand-subtitle {
            font-size: 1rem;
            letter-spacing: 8px;
            color: #D4AF37; /* Tom dourado luxo */
            text-transform: uppercase;
            font-weight: 300;
            margin-bottom: 3rem;
            margin-top: 0.5rem;
        }

        /* Botão Entrar Estilo Alta Concessionária */
        .btn-premium {
            background-color: transparent;
            color: #ffffff;
            border: 1px solid #ffffff;
            padding: 12px 50px;
            font-size: 0.9rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 400;
            border-radius: 0px;
            transition: all 0.4s ease-in-out;
            text-decoration: none;
            display: inline-block;
        }

        .btn-premium:hover {
            background-color: #ffffff;
            color: #000000 !important;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-overlay">
            <div class="text-center">

                <!-- Logótipo SS -->
                <h1 class="brand-title">SS</h1>
                <div class="brand-subtitle">Automóveis</div>
                <div class="Brand-Tagline">Excelência em cada curva</div>

                <!-- Botão de Entrada -->
                <a href="{{ route('dashboard') }}" class="btn-premium">
                    Entrar
                </a>

            </div>
        </div>
    </div>

</body>
</html>
