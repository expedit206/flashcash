
<div class="container mx-auto mt-4 fixed w-full z-10">
    @if (session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert" id="success-alert">
            <strong class="font-bold">Succès!</st  rong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" id="error-alert">
            <strong class="font-bold">Erreur!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
</div>

<script>
// Fonction pour faire disparaître les alertes après 4 secondes
setTimeout(function() {
    var successAlert = document.getElementById('success-alert');
    var errorAlert = document.getElementById('error-alert');
    if (successAlert) {
        successAlert.style.display = 'none';
    }
    if (errorAlert) {
        errorAlert.style.display = 'none';
    }
}, 10000); // 4000 millisecondes = 4 secondes
</script>
<nav class="bg-slate-700 border-t border-gray-100 fixed bottom-0 left-0 right-0 z-10">
    <div class="flex justify-around p-4">
        <a href="{{ route('produits.index') }}" class="text-white text-center {{ request()->is('produits/index') ? 'bg-yellow-400 bg-opacity-70 rounded-lg p-2' : '' }}">
            <i class="fas fa-home fa-lg"></i>
            <span class="block text-sm">Accueil</span>
        </a>
        <a href="{{ route('produit.user.index') }}" class="text-white text-center {{ request()->is('mes-produits') ? 'bg-yellow-400 bg-opacity-70 rounded-lg p-2' : '' }}">
            <i class="fas fa-box fa-lg"></i>
            <span class="block text-sm">Produits</span>
        </a>
        <a href="{{ route('epargne.index') }}" class="text-white text-center bg-yellow-500  rounded-lg p-2">
            <i class="font-bold fas fa-dollar-sign fa-lg text-gray-800"></i>
            <span class="block text-sm text-gray-800">Épargne</span>
        </a>
        <a href="{{ route('parrainage.index') }}" class="text-white text-center {{ request()->is('parrainage') ? 'bg-yellow-400 bg-opacity-70 rounded-lg p-2' : '' }}">
            <i class="fas fa-users fa-lg"></i>
            <span class="block text-sm">Équipe</span>
        </a>
        <a href="{{ route('compte.show', ['user'=> auth()->user()->id]) }}" class="text-white text-center {{ request()->is('compte/*') ? 'bg-yellow-400 bg-opacity-70 rounded-lg p-2' : '' }}">
            <i class="fas fa-user fa-lg"></i>
            <span class="block text-sm">Compte</span>
        </a>
    </div>
</nav>