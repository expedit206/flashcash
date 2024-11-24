<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold mb-6">Liste des Produits</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($produits as $produit)
                <div class="bg-gradient-to-r from-yellow-300 to-orange-800 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105">
                    <img src="/img/image.png" alt="{{ $produit->name }}" class="w-full h-32 object-cover rounded-md">
                    <div class="flex justify-between items-center mt-2">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $produit->name }}</h2> <!-- Couleur du texte ajustée -->
                        <p class="text-lg font-bold text-gray-900">{{ $produit->montant }} XAF</p> <!-- Couleur du texte ajustée -->
                    </div>
                    <p class="text-gray-800">Durée: {{ $produit->nbjour }} jours</p> <!-- Couleur du texte ajustée -->
                    <p class="text-gray-800">Stock: {{ $produit->stock }}</p> <!-- Couleur du texte ajustée -->
                    <p class="text-gray-800">Gain Journalier: {{ $produit->gainJ }} XAF</p> <!-- Couleur du texte ajustée -->
                    <p class="text-gray-800">Rendement: {{ $produit->rendement }}%</p> <!-- Couleur du texte ajustée -->
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>