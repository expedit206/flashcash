    <x-app-layout>
        <div class="p-6 pb-24">
            <h1 class="mb-4 text-2xl font-bold">Modifier l'Utilisateur</h1>
            
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @if ($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-4">
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="tel" name="telephone" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="telephone" value="{{ $user->telephone }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" name="password" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password" value="">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le Mot de passe</label>
                    <input type="password" name="password_confirmation" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password_confirmation">
                </div>

                <div class="mb-4">
                    <label for="solde_total" class="block text-sm font-medium text-gray-700">Solde Total</label>
                    <input type="number" name="solde_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="solde_total" value="{{ $user->solde_total }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="depot_total" class="block text-sm font-medium text-gray-700">Dépôt Total</label>
                    <input type="number" name="depot_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="depot_total" value="{{ $user->depot_total }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="retrait_total" class="block text-sm font-medium text-gray-700">Retrait Total</label>
                    <input type="number" name="retrait_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="retrait_total" value="{{ $user->retrait_total }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="parrain_id" class="block text-sm font-medium text-gray-700">Parrain (ID)</label>
                    <input type="text" name="parrain_id" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="parrain_id" value="{{ $user->parrain_id }}">
                </div>

                <div class="mb-4">
                    <label for="password_transaction" class="block text-sm font-medium text-gray-700">Mot de passe de transaction</label>
                    <input type="password" name="password_transaction" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password_transaction">
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Mettre à Jour l'Utilisateur</button>
            </form>
        </div>
    </x-app-layout>