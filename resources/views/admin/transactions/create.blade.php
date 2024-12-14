    <x-app-layout>
      
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Ajouter une Transaction</h1>

        <form action="{{ route('admin.transactions.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Utilisateur ID:</label>
                <input type="number" name="user_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium">Montant:</label>
                <input type="number" step="0.01" name="amount" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium">Type:</label>
                <select name="type" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="deposit">Dépôt</option>
                    <option value="withdrawal">Retrait</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Statut:</label>
                <select name="status" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="success">Succès</option>
                    <option value="failed">Échoué</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">ID de la Transaction:</label>
                <input type="text" name="transaction_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium">Méthode de Paiement:</label>
                <input type="text" name="payment_method" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Ajouter</button>
        </form>
    </div>
    </x-app-layout>