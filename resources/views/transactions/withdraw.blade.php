<x-app-layout>
    <div class="px-6 py-3 mb-4 text-white bg-gray-800 shadow-lg">
        <h2 class="mb-2 text-xl font-bold text-yellow-400">Détails de la recharge</h2>
        <div class="flex items-center justify-between mb-2 ml-3 text-sm">
            <span>Recharger votre compte FlashCash rapidement et facilement.</span>
        </div>
        <div class="flex items-center justify-between mb-2 ml-3 text-sm">
            <span>Choisissez votre fournisseur (Orange ou MTN) et entrez votre numéro de téléphone.</span>
        </div>
        <div class="ml-3 text-sm">
            <h3 class="font-semibold">Directives pour la recharge :</h3>
            <ul class="pl-5 list-disc">
                option 1 :
                <li>
 Quand vous cliquez sur recharger, patienter  <strong>15 secondes</strong>  pour que la fenêtre de validation avec code secret s'affiche
                </li>
                
                option 2 :
                <li>
                    <strong>Pour Orange :</strong> Validez votre recharge en composant le <strong>#150*50#</strong> 
                </li>
                <li>
                    <strong>Pour MTN :</strong> Validez votre recharge en composant le <strong>*126*1#</strong> 
                </li>

                    
            </ul>
        </div>
    </div>

    <form id="deposit-form" action="{{ route('withdraw.submit') }}" method="POST" class="p-6 mb-16 bg-white rounded shadow-md">
        @csrf

        <div class="mb-4">
            <p class="block text-sm font-medium text-gray-700">Choisissez le fournisseur :</p>
            <div class="flex items-center gap-6 mt-2 mb-4">
                <label class="flex items-center mr-4 cursor-pointer">
                    <input type="radio" name="provider" value="orange" required class="hidden" onchange="updateSelection('orange')">
                    <div id="orange-container" class="flex items-center justify-center w-20 h-20 p-2 transition-shadow duration-300 border border-gray-300 rounded-full hover:shadow-lg">
                        <img src="/img/orange.jpg" alt="Orange Logo" class="w-16 h-16 rounded-full">
                    </div>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="provider" value="mtn" required class="hidden" onchange="updateSelection('mtn')">
                    <div id="mtn-container" class="flex items-center justify-center w-20 h-20 p-2 transition-shadow duration-300 border border-gray-300 rounded-full hover:shadow-lg">
                        <img src="/img/mtn.jpg" alt="MTN Logo" class="w-16 h-16 rounded-full">
                    </div>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de Téléphone :</label>
            <div class="flex mt-1">
                <select  id="prefix" class="border border-gray-300 rounded-l w-[37%] p-1 py-1">
                    <option value="+237">+237 (CMR)</option>  <!-- Cameroun -->
                    <option value="+250">+250 (RWA)</option>  <!-- Rwanda -->
                    <option value="+254">+254 (KEN)</option>  <!-- Kenya -->
                    <option value="+221">+221 (SEN)</option>  <!-- Sénégal -->
                    <option value="+225">+225 (CIV)</option>  <!-- Côte d'Ivoire -->
                    <option value="+33">+33 (FRA)</option>     <!-- France -->
                    <option value="+49">+49 (DEU)</option>     <!-- Allemagne -->
                    <option value="+44">+44 (GBR)</option>     <!-- Royaume-Uni -->
                    <option value="+1">+1 (USA)</option>       <!-- États-Unis -->
                    <option value="+34">+34 (ESP)</option>     <!-- Espagne -->
                    <option value="+39">+39 (ITA)</option>     <!-- Italie -->
                    <option value="+351">+351 (PRT)</option>   <!-- Portugal -->
                    <option value="+41">+41 (CHE)</option>     <!-- Suisse -->
                    <option value="+61">+61 (AUS)</option>     <!-- Australie -->
                    <option value="+64">+64 (NZL)</option>     <!-- Nouvelle-Zélande -->
                    <option value="+81">+81 (JPN)</option>     <!-- Japon -->
                    <option value="+82">+82 (KOR)</option>     <!-- Corée du Sud -->
                    <option value="+91">+91 (IND)</option>     <!-- Inde -->
                    <option value="+86">+86 (CHN)</option>     <!-- Chine -->
                    <option value="+7">+7 (RUS)</option>       <!-- Russie -->
                    <option value="+55">+55 (BRA)</option>     <!-- Brésil -->
                </select>
                <input type="text" name="phone" required class="w-3/4 p-2 mt-0 border border-gray-300 rounded-r" min='digits_between:9,15' max='digits_between:9,15' oninput="checkForm()">
            </div>
            @error('phone')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md  text-black italic">

                {{ $message }}
            </p>
        @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Montant :</label>
            <input type="number" name="amount" required class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="min: 1000XAF" oninput="checkForm()">
            @error('amount')
               
                <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">
                
                {{ $message }}
            </p>
            @enderror
        </div>

        <input id="submit-button" type="submit" class="p-4 text-white transition duration-300 bg-gray-600 rounded hover:bg-green-700" value="Recharger" disabled>
    </form>
{{-- 
    @if (session('error'))
        <div class="mt-4 text-red-600">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="mt-4 text-green-600">{{ session('success') }}</div>
    @endif --}}

    <script>
        function updateSelection(selected) {
            // Réinitialiser les styles
            document.getElementById('orange-container').classList.remove('border-green-500', 'bg-green-100');
            document.getElementById('mtn-container').classList.remove('border-green-500', 'bg-green-100');

            // Appliquer les styles à l'élément sélectionné
            if (selected === 'orange') {
                document.getElementById('orange-container').classList.add('border-green-500', 'bg-green-100');
            } else {
                document.getElementById('mtn-container').classList.add('border-green-500', 'bg-green-100');
            }
            checkForm(); // Vérifier l'état du formulaire après la sélection
        }

        function checkForm() {
            const selectedProvider = document.querySelector('input[name="provider"]:checked');
            const phoneInput = document.querySelector('input[name="phone"]').value.trim();
            const amountInput = document.querySelector('input[name="amount"]').value.trim();
            const submitButton = document.getElementById('submit-button');

            // Activer le bouton si toutes les conditions sont remplies
            if (selectedProvider && phoneInput && amountInput) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitButton.classList.add('bg-green-600', 'hover:bg-green-700');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitButton.classList.remove('bg-green-600', 'hover:bg-green-700');
            }
        }
    </script>
</x-app-layout>