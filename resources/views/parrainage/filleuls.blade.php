<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-gray-800 text-white p-6 shadow-lg rounded-lg mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-yellow-500">Records d'Équipe</h1>
            <p class="mt-2 text-gray-300 text-sm md:text-base">Suivez vos revenus de commission et l'évolution de votre équipe de parrainage.</p>
        </div>

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
            <div id="niveau1" class="tab-content mb-6">
                <p class="text-gray-700 mb-2 font-semibold">Total Investissement : <span class="text-yellow-500">{{ number_format($totalFirstDepositsNiveau1, 2, ',', ' ') }} XAF</span></p>
                <div class="bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($niveaux[1] as $filleul)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $filleul->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ number_format($filleul->premier_depot, 2, ',', ' ') }} XAF</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="px-6 py-2 text-sm text-gray-600">
                                        Date de Création : {{ $filleul->date_de_creation_premier_depot ? $filleul->date_de_creation_premier_depot->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="niveau2" class="tab-content hidden mb-6">
                <p class="text-gray-700 mb-2 font-semibold">Total Investissement : <span class="text-yellow-500">{{ number_format($totalFirstDepositsNiveau2, 2, ',', ' ') }} XAF</span></p>
                <div class="bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($niveaux[2] as $filleul)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $filleul->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ number_format($filleul->premier_depot, 2, ',', ' ') }} XAF</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="px-6 py-2 text-sm text-gray-600">
                                        Date de Création : {{ $filleul->date_de_creation_premier_depot ? $filleul->date_de_creation_premier_depot->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="niveau3" class="tab-content hidden mb-6">
                <p class="text-gray-700 mb-2 font-semibold">Total Investissement : <span class="text-yellow-500">{{ number_format($totalFirstDepositsNiveau3, 2, ',', ' ') }} XAF</span></p>
                <div class="bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($niveaux[3] as $filleul)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $filleul->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ number_format($filleul->premier_depot, 2, ',', ' ') }} XAF</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="px-6 py-2 text-sm text-gray-600">
                                        Date de Création : {{ $filleul->date_de_creation_premier_depot ? $filleul->date_de_creation_premier_depot->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const activeNiveau = {{ $niveau }};
        function showTab(niveau) {
            document.getElementById('niveau1').style.display = 'none';
            document.getElementById('niveau2').style.display = 'none';
            document.getElementById('niveau3').style.display = 'none';

            document.getElementById('niveau' + niveau).style.display = 'block';

            const tabs = document.querySelectorAll('ul li a');
            tabs.forEach(tab => {
                tab.classList.remove('text-blue-500', 'border-blue-500', 'border');
                tab.classList.add('text-gray-600');
            });

            const activeTab = document.querySelector(`ul li:nth-child(${niveau}) a`);
            activeTab.classList.add('text-blue-500', 'border-blue-500', 'border-b');
        }

        document.addEventListener('DOMContentLoaded', () => {
            showTab(activeNiveau);
        });
    </script>
</x-app-layout>