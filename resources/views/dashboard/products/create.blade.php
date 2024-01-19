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
                <h1 class="mb-3 font-bold">Create Product</h2>

                    <form class="space-y-6" action="{{ route('products.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Name</label>
                            <input type="text" name="name" id="name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black">
                        </div>

                        <div>
                            <label for="category_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Category</label>
                            <select required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                name="category_id" id="category_id">
                                <option disabled selected value={{ null }}>Choose One</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Price</label>
                            <input type="number"step="0.01" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black">
                        </div>

                        <div>
                            <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Tags</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                id="tags" required name="tags[]" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Image</label>
                            <input type="file" name="image" id="image"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black">
                        </div>

                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Description</label>
                            <textarea
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-300 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                name="description" id="description" cols="36" rows="5"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save
                        </button>

                    </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#tags').select2();
            });
        </script>
    @endsection

</x-app-layout>
