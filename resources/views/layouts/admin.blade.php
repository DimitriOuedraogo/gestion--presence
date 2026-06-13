<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion de Présence')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col">

            <div class="p-6 border-b border-slate-700">
                <h1 class="text-xl font-bold">
                    Gestion Présence
                </h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    🏠 Tableau de bord
                </a>

                <a href="{{ route('admin.point-presences.index') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    📍 Points de présence
                </a>

                <a href="#"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    👥 Agents
                </a>

                <a href="#"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    🕒 Présences
                </a>

                <a href="#"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    📊 Rapports
                </a>

            </nav>

        </aside>

        <!-- Contenu -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->
            <header class="bg-white shadow-sm border-b">

                <div class="flex items-center justify-between px-6 py-4">

                    <h2 class="font-semibold text-slate-700">
                        @yield('page-title', 'Dashboard')
                    </h2>

                    <div class="flex items-center gap-4">

                        <span class="text-sm text-slate-500">
                            {{ auth()->user()->name ?? 'Administrateur' }}
                        </span>

                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                            A
                        </div>

                    </div>

                </div>

            </header>

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