<x-app-layout>
    <div class="container mx-auto pb-1 p-3">
        <div class="flex items-center mb-4">
            <a href="{{ url()->previous() }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-bold">Profil de transaction</h2>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
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
                    <input type="password" id="current_password" name="current_password" required class="mt-1 block w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password_transaction" class="block text-gray-700">Nouveau mot de passe de transaction</label>
                    <input type="password" id="password_transaction" name="password_transaction" required class="mt-1 block w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password_transaction_confirmation" class="block text-gray-700">Confirmer le nouveau mot de passe de transaction</label>
                    <input type="password" id="password_transaction_confirmation" name="password_transaction_confirmation" required class="mt-1 block w-full border rounded-md">
                </div>

                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">Modifier</button>
            </form>
        </div>
    </div>
</x-app-layout>