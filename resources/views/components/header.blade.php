<header class="bg-gray-800 text-white py-2">

    <div class="container mx-auto flex  items-center justify-center">

        <div class="flex items-start flex-col justify-between w-[35%] h-[35%]">
            <h1 class="text-mdl font-bold text-center">FlaxhCash</h1>

            <x-application-logo class="" />

        </div>

        <div class="mt-2 pl-3 text-white">

            <p class="">Tel : {{ auth()->user()->telephone }}
            </p>
            <p class="">Code : {{ auth()->user()->id }}</p>

        </div>

    </div>

</header>