<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Marquage de présence')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md mx-auto px-4 py-8">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Gestion Présence</h1>
            <p class="text-slate-500 text-sm mt-1">Système de suivi des formations</p>
        </div>

        @yield('content')

    </div>

</body>
</html>
