<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm mx-auto">

        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Gestion Présence</h1>
            <p class="text-slate-500 text-sm mt-1">Connectez-vous pour accéder à l'admin</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

            @if(session('success'))
            <div class="flex items-center gap-2 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm mb-6">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm mb-6">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autofocus
                        autocomplete="current-password"
                        placeholder="Entrez votre mot de passe"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-slate-800 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password') border-red-400 bg-red-50 @enderror"
                    >
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition text-sm shadow-sm">
                    Se connecter
                </button>

            </form>

        </div>

        <p class="text-center text-slate-400 text-xs mt-6">&copy; {{ date('Y') }} Gestion Présence</p>

    </div>

</body>
</html>
