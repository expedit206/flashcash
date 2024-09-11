<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comptes par Pack') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Comptes par Pack</h1>

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th>Pack</th>
                                <th>Nombre de Comptes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packs as $pack)
                                <tr>
                                    <td>{{ $pack->nom }}</td>
                                    <td>{{ $pack->comptes_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div
