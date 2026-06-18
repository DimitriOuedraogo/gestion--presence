<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Présence')</title>

    <!-- Intégration de la police Inter pour un rendu d'interface moderne -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-slate-100 text-slate-900 antialiased">

    <div class="min-h-screen flex">

        <!-- Emplacement Sidebar (si incluse dans les vues filles ou layouts intermédiaires) -->

        <!-- Conteneur de Contenu Principal -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Emplacement Navbar (si incluse dans les vues filles ou layouts intermédiaires) -->

            <!-- Injection de la page principale -->
            <main class="p-6 max-w-7xl w-full mx-auto">

                <!-- Notification Flash : Succès -->
                @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm font-medium flex items-start shadow-sm transition-all">
                    <svg class="w-5 h-5 text-emerald-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                <!-- Notification Flash : Erreur -->
                @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-100 text-rose-800 text-sm font-medium flex items-start shadow-sm transition-all">
                    <svg class="w-5 h-5 text-rose-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
                @endif

                <!-- Contenu de la vue -->
                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>