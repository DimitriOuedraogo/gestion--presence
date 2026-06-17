<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ' Présence')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->

        <!-- Contenu -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->

            <!-- Page -->
            <main class="p-6">

                @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>