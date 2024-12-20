<x-app-layout>
    <div class="px-6 py-3 mb-2 text-white bg-gray-800 shadow-lg">
        <h2 class="mb-2 text-xl font-bold text-yellow-400">Détails du retrait</h2>
        <div class="flex items-center justify-between mb-2 ml-3 text-sm">
            <span>Retirez de l'argent de votre compte FlashCash de manière simplifiée.</span>
        </div>
    </div>

    <!-- Message concernant les frais de retrait -->
    <div class="p-4 mb-1 text-sm text-gray-800 bg-yellow-100 border border-yellow-300 rounded">
        <p>Les frais de retrait sont de <span class="font-bold">15%</span> du montant total de retrait.</p>
        <p>Le montant minimum du premier retrait est de <span class="font-bold">3000 XAF (1000 XAF pour le premier retrait).</span> </p>
    </div>

    <form id="deposit-form" action="{{ route('deposit.submit') }}" method="POST" class="p-6 mb-24 bg-white rounded shadow-md">
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
                <select id="prefix" class="border border-gray-300 rounded-l w-[37%] p-1 py-1">
                    <option value="+237">+237 (CMR)</option>
                    <option value="+250">+250 (RWA)</option>
                    <option value="+254">+254 (KEN)</option>
                    <option value="+221">+221 (SEN)</option>
                    <option value="+225">+225 (CIV)</option>
                    <option value="+33">+33 (FRA)</option>
                    <option value="+49">+49 (DEU)</option>
                    <option value="+44">+44 (GBR)</option>
                    <option value="+1">+1 (USA)</option>
                    <option value="+34">+34 (ESP)</option>
                    <option value="+39">+39 (ITA)</option>
                    <option value="+351">+351 (PRT)</option>
                    <option value="+41">+41 (CHE)</option>
                    <option value="+61">+61 (AUS)</option>
                    <option value="+64">+64 (NZL)</option>
                    <option value="+81">+81 (JPN)</option>
                    <option value="+82">+82 (KOR)</option>
                    <option value="+91">+91 (IND)</option>
                    <option value="+86">+86 (CHN)</option>
                    <option value="+7">+7 (RUS)</option>
                    <option value="+55">+55 (BRA)</option>
                </select>
                <input type="text" name="phone" required class="w-3/4 p-2 mt-0 border border-gray-300 rounded-r" min='digits_between:9,15' max='digits_between:9,15' oninput="checkForm()">
            </div>
            @error('phone')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Montant :</label>
            <input type="number" name="amount" required class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="min: 1000XAF" oninput="checkForm()" min='1000'>
            @error('amount')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="transaction_password" class="block text-sm font-medium text-gray-700">Mot de passe de transaction :</label>
            <input type="password" name="password_transaction" required class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="0000 par défaut">
            <p class="text-sm italic">0000 par défaut</p>
            @error('transaction_password')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <input id="submit-button" type="submit" class="p-4 text-white transition duration-300 bg-gray-600 rounded hover:bg-green-700" value="Retirer" disabled>
    </form>

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