<x-app-layout>
    <div class="bg-gray-800 text-white px-6 py-3 shadow-lg mb-4">
        <h2 class="text-xl font-bold mb-2 text-yellow-400">Détails du retrait</h2>
        <div class="flex justify-between items-center mb-2 text-sm ml-3">
            <span>Retirez de l'argent de votre compte FlashCash de manière simplifiée.</span>
        </div>
        <div class="flex justify-between items-center mb-2 text-sm ml-3">
            <span>Choisissez votre fournisseur (Orange ou MTN) et entrez votre numéro de téléphone.</span>
        </div>
    </div>

    <form id="deposit-form" action="{{ route('deposit.submit') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
    
        <div class="mb-4">
            <p class="block text-sm font-medium text-gray-700">Choisissez le fournisseur :</p>
            <div class="flex items-center mt-2 mb-4 gap-6">
                <label class="flex items-center mr-4 cursor-pointer">
                    <input type="radio" name="provider" value="orange" required class="hidden" onchange="updateSelection('orange')">
                    <div id="orange-container" class="border border-gray-300 rounded-full p-2 hover:shadow-lg transition-shadow duration-300 flex items-center justify-center h-20 w-20">
                        <img src="/img/orange.jpg" alt="Orange Logo" class="h-16 w-16 rounded-full">
                    </div>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="provider" value="mtn" required class="hidden" onchange="updateSelection('mtn')">
                    <div id="mtn-container" class="border border-gray-300 rounded-full p-2 hover:shadow-lg transition-shadow duration-300 flex items-center justify-center h-20 w-20">
                        <img src="/img/mtn.jpg" alt="MTN Logo" class="h-16 w-16 rounded-full">
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
                <input type="text" name="phone" required class="mt-0 p-2 border border-gray-300 rounded-r w-3/4" min='digits_between:9,15' max='digits_between:9,15' oninput="checkForm()">
            </div>
            @error('phone')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Montant :</label>
            <input type="number" name="amount" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="min: 1000XAF" oninput="checkForm()" min='1000'>
            @error('amount')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="transaction_password" class="block text-sm font-medium text-gray-700">Mot de passe de transaction :</label>
            <input type="password" name="password_transaction" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="0000 par defaut">
            <p class="italic text-sm">0000 par defaut</p>
            @error('transaction_password')
            <p class="bg-[rgba(255,0,0,0.2)] p-3 rounded-md text-black italic">{{ $message }}</p>
            @enderror
        </div>
    
        <input id="submit-button" type="submit" class="bg-gray-600 text-white p-4 rounded hover:bg-green-700 transition duration-300" value="Retirer" disabled>
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

    {{-- @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif --}}
</x-app-layout>