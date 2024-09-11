<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Liste des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Telephone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.comptes', $user->id) }}" class="text-blue-500">Voir les Comptes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
