
    <x-app-layout>
        <div class="p-6">
            <h1 class="mb-4 text-2xl font-bold">Créer un Nouvel Utilisateur</h1>
            
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="name" required>
                </div>

                <div class="mb-4">
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="tel" name="telephone" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="telephone" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le Mot de passe</label>
                    <input type="password" name="password_confirmation" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password_confirmation" required>
                </div>

                <div class="mb-4">
                    <label for="solde_total" class="block text-sm font-medium text-gray-700">Solde Total</label>
                    <input type="number" name="solde_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="solde_total" value="0" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="depot_total" class="block text-sm font-medium text-gray-700">Dépôt Total</label>
                    <input type="number" name="depot_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="depot_total" value="0" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="retrait_total" class="block text-sm font-medium text-gray-700">Retrait Total</label>
                    <input type="number" name="retrait_total" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="retrait_total" value="0" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="parrain_id" class="block text-sm font-medium text-gray-700">Parrain (ID)</label>
                    <input type="number" name="parrain_id" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="parrain_id" value="">
                </div>

                <div class="mb-4">
                    <label for="password_transaction" class="block text-sm font-medium text-gray-700">Mot de passe de transaction</label>
                    <input type="password" name="password_transaction" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" id="password_transaction">
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Créer l'Utilisateur</button>
            </form>
        </div>
    </x-app-layout>