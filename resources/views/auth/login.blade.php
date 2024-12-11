<x-guest-layout>
    <!-- Session Status -->

    {{-- <style>
        body{
            background: url('/img/bg-login-jpg');
        }
    </style> --}}
{{-- <div class="h-[60vh] "> --}}
   
        
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <p class="text-xl font-bold text-center text-white">Connexion</p>
    <form method="POST" action="{{ route('login') }}" class=''>
        @csrf

        <!-- Téléphone -->
        <div class="flex flex-col gap-2 mt-4">
            
            
            <div class="mt-4">
                <x-input-label for="phone" class="ml-8 text-white" :value="__('Telephone')" />
                <div class="flex items-center gap-2">
                    <span class="text-xl">📞</span>
                    <x-text-input id="phone" class="block w-full mt-1" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" placeholder="654879542" min="9" />
                </div>
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                </div>
                
                <!-- Mot de passe -->
            <!-- Emoji pour le téléphone -->
            <div class="mt-4">
                
            <x-input-label for="password" class="ml-8 text-white" :value="__('Password')" />
            <div class="flex items-center gap-2">
            <span class="text-xl">🔑</span> <!-- Emoji pour le mot de passe -->
                <x-text-input id="password" class="block w-full mt-1"
                type="password"
                name="password"
                required autocomplete="current-password" placeholder="Votre mot de passe" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 ml-8">
            <label for="remember_me" class="inline-flex items-center text-white">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-800 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-white ms-2">{{ __('Remember me') }}</span>
                <span class="text-xl">🔄</span> <!-- Emoji pour "Remember me" -->
            </label>
        </div>
        
        <div class="flex items-center justify-around mt-4">
            <p class="">
                {{-- Pas encore de compte ?  --}}
                <a href="{{ route('register', request('user_id')) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Créer un compte</a>
            </p>
            <x-primary-button class="ms-3">
                {{ __('Connexion') }}
            </x-primary-button>
        </div>
        
    </form>
</div>

{{-- </div> --}}
</x-guest-layout>