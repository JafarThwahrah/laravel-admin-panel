<x-app-layout>
    <div class="py-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600 font-bold text-center p-2">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex justify-center">
            <div class="p-5 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="space-y-6" action="{{ route('categories.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h1 class="mb-3 font-bold">Create Category</h2>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Name</label>
                            <input type="text" name="name" id="name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save
                    </button>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
