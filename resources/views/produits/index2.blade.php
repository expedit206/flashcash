<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between text-xl font-semibold leading-tight text-green-300">

            <h2 class="text-xl font-semibold leading-tight text-gray-100">
                {{ __('Pack Disponibls') }}
            </h2>
            <div class="flex gap-4">

                <a href="{{ route('comptes.index') }}">
                    <span>Mon GAME <i class="text-blue-400 fas fa-chart-line text-1xl"></i></span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen py-12 bg-gray-800">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    @if(session('success'))
                        <div class="p-3 mb-4 text-white bg-green-500 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($produits as $pack)
                        {{-- @dd($produits) --}}
                            <div class="flex flex-col items-center p-6 bg-gray-700 rounded-lg shadow-md ">
                                <p><i class="fas  {{ $pack->icon }}
                                    {{$pack->name == 'Junior'? 'text-green-300':""}}
                                     {{$pack->name == 'Elite'? 'text-blue-600':""}}
                                     {{($pack->name == 'Champion'? 'text-orange-300':"")}}
                                     {{($pack->name == 'Visionary'? 'text-yellow-500':"")}}
                                     {{($pack->name == 'Legendary'? 'text-purple-600':"")}}
                                     {{($pack->name == 'Ultimate'? 'text-sky-500':'')}}

                                 text-6xl"></i></p>
                                <h3 class="mb-2 text-3xl font-bold text-gray-100">{{ $pack->name }}</h3>
                                <p class="mb-4 text-gray-300">Montant: {{ $pack->montant }} Fcfa</p>
                                <span class="mb-4 text-gray-300">Gain:

                                    @auth
                                    @if(Auth::user()->id==3)
                                        {{ $pack->montant*0.10 }}
                                        @else
                                        {{ $pack->montant*0.16 }}
                                        @endif
                                        @endauth

                                        @guest
                                        {{ $pack->montant*0.10 }}

                                        @endguest

                                    Fcfa/jour</span>
                                <form action="{{ route('produits.subscribe', $pack->id) }}" method="POST">
                                    @csrf

                                  <div class="flex items-center gap-4">
                                      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                          Souscrire
                                        </button>
                                    @auth
                                        <a href="{{ route('comptes.show',['user'=>auth()->user()->id, 'pack'=>$pack->id]) }}" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-400">Voir</a>

                    @if (auth()->user()->isAdmin() )
                        <a href="{{ route('produits.edit', $pack->id) }}" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-400">Modifier</a>
                    </td>
                    @endif
                                    @endauth
                                    </div>
                                </form>
                            </div>

                            @empty

                            <p>Aucun pack disponible</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

  
</x-app-layout>
