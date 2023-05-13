<x-layout>

    @include('partials._hero')

    <div class="w-full flex md:justify-center lg:justify-center xl:justify-center">
        <div class="md:w-[95%] lg:w-[90%] xl:w-[80%] flex flex-col">

            @include('partials._search')

            @unless (count($listings) == 0)

                <div class="container flex flex-col items-center">
                    <div class="grid lg:grid-cols-2 xl:grid-cols-2">
                        @foreach ($listings as $listing)

                            <x-listing-card :listing=$listing />

                        @endforeach
                    </div>

                    <div class="min-w-[90%] mt-10 md:w-[60%] lg:w-[40%]">{{ $listings->links() }}</div>
                </div>

            @else

                <h1 class="text-2xl text-center uppercase text-red-900 font-bold p-20">oops! no results!</h1>

            @endunless
        </div>
    </div>

</x-layout>




