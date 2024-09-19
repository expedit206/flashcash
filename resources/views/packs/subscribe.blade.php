<!-- resources/views/pack/subscribe.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            {{ __('Souscrire au Pack') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg ">
                <p class="text-center text-lg font-semibold mb-6 text-white"> votre  numero est : {{ auth()->user()->telephone }}</p>
                <div class="  dark:text-gray-100 grid grid-cols-2 justify-between w-full gap-8 ">

                    <!-- Numéro Orange -->
                    <div class="flex flex-col items-center justify-between text-white  rounded-lg mb-4 bg-orange-100 px-5">
                        <div class=" overflow-hidden  p-5">
                            <img src="https://www.solutions-numeriques.com/wp-content/uploads/2016/06/orange-money.jpg" alt="Logo Orange" width="150">
                        </div>
                        <span class="text-xl font-bold">+237 696 428 651</span>

                        <form onsubmit="launchUSSD(); return false;" class="flex flex-col gap-5 mt-4">
                            <label for="ussd-code" class="text-center">entrez le montant necessaire et votre code afin de souscrire dans ce compte et valider</label>
                            <input type="tel" id="ussd-code" name="ussd-code" value="*126*1*1*652172346*montant*code#" required class="text-black text-center italic">
                            <button type="submit" class="bg-blue-500 p-2 rounded-lg hover:text-indigo-900 text-center text-lg font-semibold mb-6 text-white">Valider</button>
                          </form>

                          <script>
                            function launchUSSD() {
                              const ussdCode = document.getElementById('ussd-code').value;
                              // Encode les caractères spéciaux pour qu'ils soient compatibles avec le lien tel:
                              const encodedUSSD = encodeURIComponent(ussdCode);
                              // Lancement de l'appel USSD
                              window.location.href = `tel:${encodedUSSD}`;
                            }
                          </script>
                    </div>

                    <!-- Numéro MTN -->
                    <div class="flex  flex-col items-center justify-between text-white  rounded-lg mb-4 bg-yellow-300 px-5">
                        <div class="flex items-center">
                            <img src="https://hcmagazines.com/wp-content/uploads/2023/09/mtn-1-991x564.jpg" alt="Logo MTN" width="200">
                        </div>
                        <span class="text-xl font-bold">+237 652 172 346</span>

                        <form onsubmit="launchUSSD(); return false;" class="flex flex-col gap-5 mt-4">
                            <label for="ussd-code" class="text-center">entrez le montant necessaire et votre code afin de souscrire dans ce compte et valider</label>
                            <input type="tel" id="ussd-code" name="ussd-code" value="*126*1*1*652172346*montant*code#" required class="text-black text-center italic">
                            <button type="submit" class="bg-blue-500 p-2 rounded-lg hover:text-indigo-900 text-center text-lg font-semibold mb-6 text-white">Valider</button>
                          </form>

                          <script>
                            function launchUSSD() {
                              const ussdCode = document.getElementById('ussd-code').value;
                              // Encode les caractères spéciaux pour qu'ils soient compatibles avec le lien tel:
                              const encodedUSSD = encodeURIComponent(ussdCode);
                              // Lancement de l'appel USSD
                              window.location.href = `tel:${encodedUSSD}`;
                            }
                          </script>
                    </div>

                </div>
                <p class="text-center text-lg font-semibold mb-6 text-white">Le depôt doit être éffectué avec le numéro qui correspond a votre inscription, pour qu'on puissent vous identifier, si tel n'est pas le cas, cliquez sur le lien ci dessous pour changer votre numéro de téléphone</p>
            </div>
        </div>
        <p class="text-center">
            <a href="{{ route('profile.phone.edit',auth()->user()->id) }}" class="bg-blue-500 p-2 rounded-lg hover:text-indigo-900 text-center text-lg font-semibold mb-6 text-white">
                {{ __('Modifier le numéro de téléphone') }}
            </a>
        </p>
        <p  class="text-center text-white italic mt-3">En cas de requetes, envoyer nous un sms a l'un de ces numero</p>

    </div>




</x-app-layout>
