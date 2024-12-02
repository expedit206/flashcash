<x-guest-layout>
    <!-- Session Status -->

    {{-- <style>
        body{
            background: url('/img/bg-login-jpg');
        }
    </style> --}}
<div class="h-[40vh] ">
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <p class="text-center font-bold text-xl">Connexion</p>
    <form method="POST" action="{{ route('login') }}" class=''>
        @csrf

        <!-- Téléphone -->
        <div class="mt-4 flex flex-col gap-2">
            
            
            <div class="mt-4">
                <x-input-label for="phone" class="ml-8" :value="__('Telephone')" />
                <div class="flex gap-2 items-center">
                    <span class="text-xl">📞</span>
                    <x-text-input id="phone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" placeholder="654879542" min="9" />
                </div>
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                </div>
                
                <!-- Mot de passe -->
            <!-- Emoji pour le téléphone -->
            <div class="mt-4">
                
            <x-input-label for="password" class="ml-8" :value="__('Password')" />
            <div class="flex gap-2 items-center">
            <span class="text-xl">🔑</span> <!-- Emoji pour le mot de passe -->
                <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" placeholder="Votre mot de passe" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 ml-8">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                <span class="text-xl">🔄</span> <!-- Emoji pour "Remember me" -->
            </label>
        </div>
        
        <div class="flex  justify-around mt-4 items-center">
            <x-primary-button class="ms-3">
                {{ __('Connexion') }}
            </x-primary-button>
            <p class="">
                {{-- Pas encore de compte ?  --}}
                <a href="{{ route('register', request('user_id')) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Créer un compte</a>
            </p>
        </div>
        
    </form>
</div>
</x-guest-layout>