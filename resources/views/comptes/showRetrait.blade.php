<!-- resources/views/retrait/show.blade.php -->
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Faire un retrait') }}
        </h2>
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md font-bold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-4 bg-red-500 text-white rounded-md">
            {{ session('error') }}
        </div>
    @endif
    </x-slot>

    <div class="max-w-lg mx-auto mt-8 p-6e rounded-lg shadow-md shadow-black p-4 bg-gray-400 w-full">
        <h1 class="text-2xl font-bold mb-4">Faire un retrait</h1>
        

    <form action="{{ route('retrait.store', $item->id) }}" method="POST" class="w-full">
        @csrf
        <div class="mb-4">
            <label for="montant" class="block text-sm font-medium text-gray-700">Montant du retrait en FCFA(Minimum 4000FCFA)</label>
            <input 
                type="number" 
                name="montant" 
                id="montant" 
                min="0" 
                step="0.01" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm shadow-black focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                required
            >
        </div>
        <div class="mb-4">
            <label for="confirmation" class="block text-sm font-medium text-gray-700">Êtes-vous sûr de vouloir effectuer le retrait ?</label>
            <input type="hidden" name="item_id" value="{{ $item->id }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Confirmer le retrait
        </button>
    </form>
</div>
</x-app-layout>
