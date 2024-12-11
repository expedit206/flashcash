<header class="py-2 text-white bg-gray-800">

    <div class="container flex items-center justify-center mx-auto">

        <div class="flex  flex-col items-center justify-between w-[35%] h-[31%]">
            <h1 class="font-bold text-center text-mdl">FlashCash</h1>

            <x-application-logo class="" />

        </div>

        <div class="pl-3 mt-2 text-white">

            <p class="">Tel : {{ auth()->user()->telephone }}
            </p>
            <p class="">Code : {{ auth()->user()->id }}</p>

        </div>

    </div>

</header>