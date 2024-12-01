<x-app-layout>
    <h1>Depot d'Argent</h1>
    <form action="{{ route('withdraw.submit') }}" method="POST">
        @csrf
        <label for="phone">Numéro de Téléphone :</label>
        <input type="text" name="phone" required>

        <label for="amount">Montant :</label>
        <input type="number" name="amount" required>

        <button type="submit">Depot</button>
    </form>
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
</x-app-layout>
    