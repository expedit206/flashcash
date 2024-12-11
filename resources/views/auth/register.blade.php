<x-guest-layout>
    <p class="mt-4 text-xl font-bold text-center text-white">Inscription</p>

    <form method="POST" action="{{ route('register') }}" class="w-full h-[90vh] text-white"
    >
        @csrf

        <div class="w-full">
            <x-input-label 
            for="name" class="text-white" :value="__('Nom *')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Abena tiako"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Telephone -->
        <div class="mt-4">
            <x-input-label for="phone" class="text-white" :value="__('Téléphone *')" />
            <div class="flex ">
                <select  id="prefix" class="border border-gray-300 text-black rounded-l w-[45%] text-sm ">
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
                <x-text-input id="phone" class="block w-full" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" placeholder="654879542" min="digits_between:9,15" />
            </div>
            <span class="italic text-green-800">
                {{-- Celui avec lequel vous ferez vos transferts d'argent --}}
            </span>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

          <!-- Code de Parrainage -->
          <div class="mt-4">
            <x-input-label for="code" class="text-white" :value="__('Code de parrainage')" />
            <input type="text" name="code" hidden id="aa">
            <x-text-input id="code" class="block w-full mt-1" type="text" name="code" :value="old('code')" autocomplete="code" placeholder="Entrez le code de parrainage (facultatif)" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="text-white" :value="__('Mot de passe *')" />
            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Votre mot de passe" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" class="text-white" :value="__('Confirmer mot de passe *')" />
            <x-text-input id="password_confirmation" class="block w-full mt-1 "
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer votre mot de passe" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

      

        <div class="mt-4">
            En vous inscrivant, vous acceptez notre
            <a href="{{ route('politique.utilisation') }}" class="text-green-600 hover:text-green-900"> Politique d'Utilisation!!
            </a>
        </div>

        <div class="flex items-center justify-end mt-4">
            Déjà inscrit?
            <a class="text-sm text-green-400 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __(' Se connecter') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const codeInput = document.getElementById('code');
            const InputHidden = document.getElementById('aa');
            const urlParams = new URLSearchParams(window.location.search);
            const urlCode = urlParams.get('code');

            // Vérifie si un code est passé dans l'URL
            if (urlCode) {
                codeInput.value = urlCode; // Remplit le champ avec le code de l'URL
                codeInput.disabled = true; // Désactive le champ
                InputHidden.value = codeInput.value ;
                localStorage.setItem('code', urlCode); // Enregistre le code dans le localStorage
            } else {
                // Vérifie si un code de parrainage existe déjà dans le localStorage
                const storedCode = localStorage.getItem('code');
                if (storedCode) {
                    codeInput.readOnly = true; // Désactive le champ
                    codeInput.value = storedCode;
                     // Remplit le champ s'il existe
                }
            }
        });
    </script>
</x-guest-layout>