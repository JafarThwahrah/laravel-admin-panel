<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $tabs_style = 'p-3 hover:bg-gray-500 hover:text-white hover:font-bold rounded-md ease-in-out duration-300';
        $active_tabs_style = 'p-3 text-white bg-gray-500 font-bold ease-in-out duration-300';

    @endphp
    <div class="py-12">

        <div class="flex">
            <div class="w-1/4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col">

                    <h2 class="p-3 text-2xl font-bold"> <i class="fa-solid fa-chart-simple"></i> Admin Panel</h2>
                    <hr>


                    <hr>
                    <a href="{{ route('categories.index') }}"
                        class="{{ $tabs_style }} {{ Route::is('categories.*') ? $active_tabs_style : '' }}">
                        <i class="fa-solid fa-network-wired fa-lg m-1"></i> Categories
                    </a>

                    <hr>
                    <a href="{{ route('tags.index') }}"
                        class="{{ $tabs_style }} {{ Route::is('tags.*') ? $active_tabs_style : '' }}">
                        <i class="fa-solid fa-tags fa-lg m-1"></i>Tags
                    </a>
                    <hr>

                    <a href="{{ route('products.index') }}"
                        class="{{ $tabs_style }} {{ Route::is('products.*') ? $active_tabs_style : '' }}">
                        <i class="fa-brands fa-product-hunt fa-lg m-1"></i>Products
                    </a>
                    <hr>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="p-3 text-left w-full text-red-500 bg-white hover:bg-red-500 hover:text-white hover:font-bold rounded-md"><i
                                class="fa-solid fa-right-from-bracket fa-lg m-1"></i>Logout</button>
                    </form>
                </div>
            </div>



            <div class="w-3/4 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
