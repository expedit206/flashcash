<x-app-layout>
    <div class="p-6">
        <h2 class="mb-4 text-lg font-semibold">🌟 Devenez un Actionnaire Privilégié !</h2>
        
        <p class="mb-4 text-gray-700">
            Nous vous remercions pour votre engagement et le soutien que vous apportez à votre réseau de filleuls. En tant que leader, vous avez la possibilité de devenir un actionnaire privilégié. Votre rôle est essentiel pour notre croissance et notre succès. En soumettant ce formulaire, vous faites un pas vers une collaboration plus étroite et vous rejoignez notre communauté d'actionnaires qui travaillent ensemble pour atteindre des objectifs communs. 🚀
        </p>

        <p class="mb-4 text-gray-700">
            💬 Souhaitez-vous faire partie des actionnaires ? Votre engagement est précieux pour nous. ✨
        </p>

        <form action="{{ route('actionnaires.store') }}" method="POST">
            @csrf
            <input type="hidden" name="actionnaire_id" value="{{ $user->id }}">

            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">📞 Téléphone</label>
                <input type="text" name="telephone" placeholder="Entrez votre numéro WhatsApp" required class="w-full px-2 py-1 border rounded">
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">✅ Soumettre</button>
        </form>
    </div>
</x-app-layout>