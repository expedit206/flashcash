<x-app-layout>
    <div class="container p-3 pb-1 mx-auto">
        <div class="flex items-center mb-8">
            <a href="{{ url()->previous() }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-400">Profil de transaction</h2>
            
            
        </div>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Modifier le mot de passe de transaction') }}
            </h2>
            
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Assurez-vous que votre compte utilise un mot de passe de transaction long et aléatoire pour rester sécurisé.') }}
            </p>
        </header>
        <div class="p-6 bg-white rounded-lg shadow">
            @if ($errors->any())
                <div class="mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 text-green-500">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('updatePasswordTransaction') }}">
                @csrf

                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700">Mot de passe de connexion actuel</label>
                    
                    <input type="password" id="current_password" name="current_password" required class="block w-full mt-1 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password_transaction" class="block text-gray-700">Nouveau mot de passe de transaction</label>
                    <input type="password" id="password_transaction" name="password_transaction" required class="block w-full mt-1 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password_transaction_confirmation" class="block text-gray-700">Confirmer le nouveau mot de passe de transaction</label>
                    <input type="password" id="password_transaction_confirmation" name="password_transaction_confirmation" required class="block w-full mt-1 border rounded-md">
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-gray-500 rounded">Modifier</button>
            </form>
        </div>
    </div>
</x-app-layout>