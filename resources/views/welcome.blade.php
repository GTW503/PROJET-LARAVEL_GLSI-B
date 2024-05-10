<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel University Landing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .background-image {
            background-image: url('{{ asset('images/étu.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            color: #ffffff;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 3rem;
            text-transform: uppercase;
            margin: 0.5em 0;
        }

        .button {
            padding: 0.6em 1.2em;
            border: none;
            border-radius: 5px;
            background-color: #ff5722; /* Vibrant color */
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            font-size: 1.2rem;
            margin: 0.5em;
            transition: background-color 0.3s;
        }

        .button:hover, .button:focus {
            background-color: #e64a19; /* Darker shade for hover effect */
        }

    </style>
</head>

<body class="antialiased background-image">
    <div class="overlay">
        <h1>Bienvenue sur le site de notation d'université</h1>
        <div id="typed-text" class="text-xl font-medium"></div>
        
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="button">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="button">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button">Inscription</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        new Typed('#typed-text', {
            strings: ["Évaluations", "Commentaires", "Notations"],
            typeSpeed: 70,
            backSpeed: 70,
            loop: true
        });
    </script>
</body>

</html>
