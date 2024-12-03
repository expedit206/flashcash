<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex items-center mb-4">
            <a href="{{ route('compte.show', auth()->user()) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h4 class="text-xl font-bold">Configurer Mon Portefeuille</h4>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($wallet) ? route('wallet.update', $wallet->id) : route('wallet.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @if(isset($wallet))
                @method('POST') <!-- Si vous utilisez POST pour la mise à jour dans votre route -->
            @endif

            <div class="mb-4">
                <label for="user_name" class="block text-sm font-bold mb-2">Nom de l'Utilisateur</label>
                <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $wallet->user_name ?? '') }}" class="border rounded p-2 w-full" required>
                @error('user_name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="account_number" class="block text-sm font-bold mb-2">Numéro de Compte</label>
                <div class="flex">
                    <select  id="prefix" class="border border-gray-300 rounded-l w-[45%] text-sm ">
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
                    <input type="text" id="account_number" name="account_number" value="{{ old('account_number', $wallet->account_number ?? '') }}" class="border rounded p-2 w-full" required>
                </div>
                @error('account_number')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="service_name" class="block text-sm font-bold mb-2">Nom du Service</label>
                <select id="service_name" name="service_name" class="border rounded p-2 w-full" required>
                    <option value="" disabled {{ old('service_name', $wallet->service_name ?? '') ? '' : 'selected' }}>Sélectionnez un service</option>
                    <option value="ORANGE" {{ old('service_name', $wallet->service_name ?? '') == 'ORANGE' ? 'selected' : '' }}>Orange</option>
                    <option value="MTN" {{ old('service_name', $wallet->service_name ?? '') == 'MTN' ? 'selected' : '' }}>MTN</option>
                </select>
                @error('service_name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">{{ isset($wallet) ? 'Modifier' : 'Ajouter' }}</button>
        </form>

        <h2 class="text-xl font-bold mt-4">Mes Comptes Existants</h2>
        @if($user->wallets->isEmpty())
            <div class="bg-yellow-500 text-white p-2 rounded text-center">Aucun compte trouvé.</div>
        @else
            <ul class="mt-2">
                @foreach($user->wallets as $wallet)
                    <li class="bg-gray-200 p-2 rounded mb-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $wallet->service_name == 'ORANGE' ? '/img/orange.jpg' : '/img/mtn.jpg' }}" alt="{{ $wallet->service_name }}" class="h-8 w-8 mr-2 rounded" />
                            <div>
                                <p class="font-bold">{{ $wallet->account_number }}</p>
                                <p class="text-sm">{{ $wallet->user_name }}</p>
                            </div>
                        </div>
                        <a href="{{ route('wallet.edit', $wallet->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 transition">
                            Modifier
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>