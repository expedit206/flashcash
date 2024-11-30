<x-app-layout>
    <h1>Dépôt d'Argent</h1>
    <form action="{{ route('deposit.submit') }}" method="POST">
        @csrf

        <label for="phone">Numéro de Téléphone :</label>
        <input type="text" name="phone" required>

        <label for="amount">Montant :</label>
        <input type="number" name="amount" required>

        <label for="customer">Client :</label>
        <input type="text" name="customer" required placeholder="Numéro ou ID du client">

        <label for="location">Emplacement :</label>
        <input type="text" name="location" required placeholder="Ville ou adresse">

        <label for="product">Produit :</label>
        <input type="text" name="product" required placeholder="Nom du produit">

        <button type="submit">Déposer</button>
    </form>

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
</x-app-layout>