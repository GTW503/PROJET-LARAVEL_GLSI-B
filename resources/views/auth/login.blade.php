<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md w-full bg-white p-10 rounded-xl shadow-lg mx-auto my-20">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                Connectez-vous à votre compte
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Ou <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    créez un compte
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="sr-only">Adresse e-mail</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                       class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white" 
                       placeholder="Adresse e-mail">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="sr-only">Mot de passe</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                       class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white" 
                       placeholder="Mot de passe">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 text-sm text-gray-900">
                        Se souvenir de moi
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                            Mot de passe oublié ?
                        </a>
                    </div>
                @endif
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
