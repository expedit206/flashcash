<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @if (Auth::check())
    <p class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
        Votre lien d'affiliation :
        <a id="referral-link" href="{{ Auth::user()->referral_link }}" class="bg-slate-500 rounded-lg p-2 text-white">{{ Auth::user()->referral_link }}</a>
        <button id="copy-button" onclick="copyToClipboard()" class="bg-green-500 text-white rounded-lg p-1">Copier</button>
    </p>
@endif

<script>
    function copyToClipboard() {
        // Sélectionne l'élément du lien
        const link = document.getElementById('referral-link').href;

        // Crée un élément temporaire pour copier le texte
        const tempInput = document.createElement('input');
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Change le texte du bouton
        const button = document.getElementById('copy-button');
        button.textContent = 'Copié';

        // Réinitialise le texte du bouton après 2 secondes
        setTimeout(() => {
            button.textContent = 'Copier';
        }, 2000);
    }
</script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
