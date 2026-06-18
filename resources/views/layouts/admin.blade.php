<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Présence') — Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 antialiased">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col shrink-0">

        <!-- Logo -->
        <div class="px-5 py-4 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-500 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-sm leading-tight">Gestion Présence</p>
                    <p class="text-xs text-slate-400 mt-0.5">Administration</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-0.5">

            <p class="px-3 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('admin.session-presences.index') }}"
               class="{{ request()->routeIs('admin.session-presences.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Sessions
            </a>

            <a href="{{ route('admin.point-presences.index') }}"
               class="{{ request()->routeIs('admin.point-presences.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Points de présence
            </a>

            <a href="{{ route('admin.agents.index') }}"
               class="{{ request()->routeIs('admin.agents.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Agents
            </a>

            <div class="pt-3">
                <p class="px-3 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bientôt</p>
            </div>

            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-500 cursor-not-allowed">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Présences
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-500 cursor-not-allowed">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Rapports
            </a>

        </nav>

        <!-- User + Logout -->
        <div class="px-3 pb-4 border-t border-white/10 pt-4 space-y-2">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-slate-800">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-xs font-bold shrink-0">A</div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">Administrateur</p>
                    <p class="text-xs text-slate-400">Super admin</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-3 py-2 text-sm text-slate-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>

    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Header -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 shrink-0">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Tableau de bord')</h1>
                    @if (trim($__env->yieldContent('page-subtitle')))
                    <p class="text-xs text-slate-400 mt-0.5">@yield('page-subtitle')</p>
                    @endif
                </div>
                <span class="text-xs text-slate-400 hidden sm:block">{{ now()->format('d/m/Y') }}</span>
            </div>
        </header>

        <!-- Alerts -->
        <div class="px-6 pt-4">
            @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm mb-4">
                <svg class="w-4 h-4 shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm mb-4">
                <svg class="w-4 h-4 shrink-0 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif
        </div>

        <!-- Page content -->
        <main class="flex-1 px-6 pb-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="px-6 py-3 border-t border-slate-200 bg-white text-center">
            <p class="text-xs text-slate-400">Développé par <span class="font-semibold text-slate-500">Groupe Data 3</span> &mdash; &copy; {{ date('Y') }} Gestion Présence</p>
        </footer>

    </div>

</div>

@stack('scripts')
</body>
</html>
