<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('compte.show', auth()->user()) }}" class="mr-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-arrow-left"></i> 
        </a>
            </a>
            <h2 class="text-2xl font-bold leading-tight text-gray-500">
                {{ __('Profile connexion') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 mb-8">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>