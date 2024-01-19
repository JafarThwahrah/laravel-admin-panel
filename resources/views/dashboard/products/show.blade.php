<x-app-layout>
    <div class="py-12">

        <div class="flex justify-center">

            <div class="p-5 w-3/4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center text-4xl p-3 font-bold m-5">Tag Details</h1>
                <div class="flex justify-center">
                    <img class="h-36 text-center" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                </div>
                <h2 class="text-center text-2xl p-3"> Name : {{ $product->name }}</h2>
                <h2 class="text-center text-2xl p-3"> Price : {{ $product->price }}</h2>
                <h2 class="text-center text-2xl p-3"> Category Name : {{ $product->category->name }}</h2>
                <h2 class="text-center text-2xl p-3"> Description : {{ $product->description }}</h2>

            </div>

        </div>
    </div>

</x-app-layout>
