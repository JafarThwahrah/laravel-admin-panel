@extends('dashboard')

@section('content')
    <div class="mb-5 flex justify-between">
        <a href="{{ route('products.create') }}"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Create New Product
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
        <table id="sortableTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-black text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="sortableRows">
                @foreach ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 draggable-item cursor-pointer"
                        data-id="{{ $product->id }}" data-order="{{ $product->order }}">
                        <td class="px-6 py-4">
                            <img style="width:2rem; height:2rem; border-radius:50%;" src="{{ asset($product->image_path) }}"
                                alt="{{ $product->name }}">

                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->name }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4 flex">

                            <a href="{{ route('products.show', ['product' => $product->id]) }}"><i
                                    class="fa-solid fa-eye p-3 bg-yellow-300 rounded-md dark:text-white m-1"></i></a>
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"><i
                                    class="fa-solid fa-pen-to-square p-3 bg-cyan-300 dark:text-white rounded-md m-1"></i></a>
                            <button onclick="confirmDelete({{ $product->id }})"><i
                                    class="fa-solid fa-trash p-3 bg-red-500 rounded-md m-1 text-white"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        {{ $products->links() }}

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
                url: '/products/delete/' + id,
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
                        'Product has been deleted.',
                        'success'
                    );

                },
                error: function(xhr, status, error) {}
            });
        }

        $(function() {
            $("#sortableTable").sortable({
                items: 'tr:not(tr:first-child)',
                dropOnEmpty: false,
                start: function(event, ui) {
                    ui.item.addClass("select");
                },
                stop: function(event, ui) {
                    ui.item.removeClass("select");
                    $(this).find("tr").each(function(index) {
                        if (index > 0) {
                            $(this).find("td").eq(2).html(index);
                            $(this).attr('data-order', index);
                        }
                    });

                    var orderData = [];
                    $("#sortableTable tr").each(function(index) {
                        if (index > 0) {
                            orderData.push({
                                id: $(this).data(
                                    'id'),
                                order: $(this).data('order')
                            });
                        }
                    });

                    $.ajax({
                        url: '{{ route('products.changeOrder') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'POST',
                            data: orderData
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Product Order has been Changed.',
                                'success'
                            );
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
