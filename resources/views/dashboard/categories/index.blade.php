@extends('dashboard')

@section('content')
    <div class="mb-5 flex justify-between">
        <a href="{{ route('categories.create') }}"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Create New Category
        </a>

        @if (session('mssg'))
            <div class="flex justify-center">

                <h3 class="bg-green-400 text-white p-3 rounded-md">{{ session('mssg') }}</h3>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600 font-bold">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-black text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->name }}
                        </th>


                        <td class="px-6 py-4 flex">

                            <a href="{{ route('categories.show', ['category' => $category->id]) }}"><i
                                    class="fa-solid fa-eye p-3 bg-yellow-300 rounded-md dark:text-white m-1"></i></a>
                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}"><i
                                    class="fa-solid fa-pen-to-square p-3 bg-cyan-300 dark:text-white rounded-md m-1"></i></a>
                            <button onclick="confirmDelete({{ $category->id }})"><i
                                    class="fa-solid fa-trash p-3 bg-red-500 rounded-md m-1 text-white"></i></button>


                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        {{ $categories->links() }}

    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        function deleteItem(id) {
            $.ajax({
                url: '/categories/delete/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    setTimeout(() => {
                        location.reload();

                    }, 1000);
                    Swal.fire(
                        'Deleted!',
                        'Category has been deleted.',
                        'success'
                    );

                },
                error: function(xhr, status, error) {}
            });
        }
    </script>
@endsection
