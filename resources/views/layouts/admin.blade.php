<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion de Présence')</title>

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

<body class="h-full bg-slate-50 antialiased text-slate-900">

    <div class="min-h-screen flex">

        <aside class="w-64 bg-slate-950 text-slate-300 hidden md:flex flex-col border-r border-slate-800">

            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <div class="flex items-center space-x-2.5">
                    <div class="p-1.5 bg-emerald-500 rounded-lg text-slate-950">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span class="text-base font-bold text-white tracking-tight">
                        PrésenceAdmin
                    </span>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Tableau de bord</span>
                </a>

                <div class="pt-4 pb-1 px-4 text-xxs font-bold uppercase tracking-wider text-slate-500">Gestion</div>

                <a href="{{ route('admin.session-presences.index') }}"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.session-presences.*') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Sessions</span>
                </a>

                <a href="{{ route('admin.point-presences.index') }}"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.point-presences.*') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Points de présence</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.agents.*') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0-6a3.99 3.99 0 00-3-1.354 3.99 3.99 0 00-3 1.354m0 0a4 4 0 105.292 0M21 21v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Agents</span>
                </a>

                <div class="pt-4 pb-1 px-4 text-xxs font-bold uppercase tracking-wider text-slate-500">Analyses</div>

                <a href="{{ route('admin.presences.index') }}"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.presences.*') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Présences</span>
                </a>

                <a href="#"
                    class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 hover:bg-slate-900 hover:text-white {{ request()->routeIs('admin.reports.*') ? 'bg-slate-900 text-emerald-400 font-semibold' : 'text-slate-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                    </svg>
                    <span>Rapports</span>
                </a>

            </nav>

        </aside>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10 shrink-0">

                <h2 class="text-lg font-semibold text-slate-800 tracking-tight">
                    @yield('page-title', 'Tableau de bord')
                </h2>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-600 hidden sm:inline-block">
                        {{ auth()->user()->name ?? 'Administrateur' }}
                    </span>

                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white font-semibold text-sm shadow-sm border border-emerald-200">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>

            </header>

            <main class="flex-1 overflow-y-auto p-8 layout-content">

                @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-start space-x-3 shadow-sm">
                    <svg class="h-5 w-5 text-emerald-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-semibold">Succès !</span> {{ session('success') }}
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-start space-x-3 shadow-sm">
                    <svg class="h-5 w-5 text-rose-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-semibold">Erreur !</span> {{ session('error') }}
                    </div>
                </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>