<x-app-layout>
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Records d'Équipe</h1>

    <!-- Onglets Horizontaux -->
    <div class="mb-4">
        <ul class="flex border-b">
            <li class="mr-1">
                <a class="inline-block py-2 px-4 font-semibold text-blue-500 border-b-2 border-blue-500" href="#" onclick="showTab(1)">Niveau 1 ({{ count($niveaux[1]) }})</a>
            </li>
            <li class="mr-1">
                <a class="inline-block py-2 px-4 text-gray-600 hover:text-blue-500" href="#" onclick="showTab(2)">Niveau 2 ({{ count($niveaux[2]) }})</a>
            </li>
            <li>
                <a class="inline-block py-2 px-4 text-gray-600 hover:text-blue-500" href="#" onclick="showTab(3)">Niveau 3 ({{ count($niveaux[3]) }})</a>
            </li>
        </ul>
    </div>

    <!-- Contenu -->
    <div id="content">
        <div id="niveau1" class="tab-content">
            <h3 class="text-lg font-semibold mb-2">Niveau 1</h3>
            <ul class="list-group">
                @foreach ($niveaux[1] as $filleul)
                    <li class="list-group-item p-2 border border-gray-300 rounded mb-2">{{ $filleul->name }}</li>
                @endforeach
            </ul>
        </div>
        
        <div id="niveau2" class="tab-content hidden">
            <h3 class="text-lg font-semibold mb-2">Niveau 2</h3>
            <ul class="list-group">
                @foreach ($niveaux[2] as $filleul)
                    <li class="list-group-item p-2 border border-gray-300 rounded mb-2">{{ $filleul->name }}</li>
                @endforeach
            </ul>
        </div>
        
        <div id="niveau3" class="tab-content hidden">
            <h3 class="text-lg font-semibold mb-2">Niveau 3</h3>
            <ul class="list-group">
                @foreach ($niveaux[3] as $filleul)
                    <li class="list-group-item p-2 border border-gray-300 rounded mb-2">{{ $filleul->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    function showTab(niveau) {
        // Cacher tous les contenus
        document.getElementById('niveau1').style.display = 'none';
        document.getElementById('niveau2').style.display = 'none';
        document.getElementById('niveau3').style.display = 'none';

        // Afficher le contenu sélectionné
        document.getElementById('niveau' + niveau).style.display = 'block';

        // Mettre à jour les classes des onglets
        const tabs = document.querySelectorAll('ul li a');
        tabs.forEach(tab => {
            tab.classList.remove('text-blue-500', 'border-blue-500');
            tab.classList.add('text-gray-600');
        });

        const activeTab = document.querySelector(`ul li:nth-child(${niveau}) a`);
        activeTab.classList.add('text-blue-500', 'border-blue-500');
    }
</script>
    </x-app-layout>