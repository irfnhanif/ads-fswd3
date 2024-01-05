<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl flex justify-center py-7">Products Catalog</h1>
                    @if ($isAdmin)
                        <div class="flex justify-end mb-8 mr-24">
                            <a href="{{ route('products.create', ['product' => 'product' ]) }}" class="btn btn-outline">Add Product</a>
                        </div>
                    @endif
                    <div class="flex flex-wrap space-x-4 justify-center">
                        @foreach ($products as $product)
                            <div class="card w-80 bg-base-100 shadow-xl mb-8">
                                <figure>
                                    <img src="
                                        @if (empty($product['image']))
                                            {{ asset('images/default.jpg') }}
                                        @else
                                            {{ asset('storage/images/'.$product['image']) }}
                                        @endif
                                    " alt="Product Image" />
                                </figure>
                                <div class="card-body">
                                    <h2 class="card-title">{{ $product['name'] }}</h2>
                                    <p>{{ $product['description'] }}</p>
                                    <p>${{ $product['price'] }}</p>
                                    @if ($isAdmin)
                                        <div class="flex justify-end">
                                            <a href="{{ route('products.edit', ['product_id' => $product->id]) }}">
                                                <img src="{{ asset('svg/edit.svg') }}" alt="Edit" class="w-7 h-7 flex justify-end mr-2" />
                                            </a>
                                            <form action="{{ route('products.destroy', ['product_id' => $product->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <img src="{{ asset('svg/bin.svg') }}" alt="Delete" class="w-7 h-7 flex justify-end" />
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="card-actions justify-end">
                                            <a href="" class="btn btn-neutral">Purchase</a>
                                            <button data-url="{{ url('api/cart/' . $product->id) }}" class="btn btn-accent add-to-cart">Cart</button>
                                        </div>  
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="footer footer-center p-4 bg-gray-200 text-base-content sm:rounded-lg">
            <aside>
                <p>FSWD 3 - ADS Digital Partner © 2024 - Irfan Hanif Habibi</p>
            </aside>
            </footer>
        </div>
    </div>
</x-app-layout>

<script>
    var apiToken = "{{ session('api_token') }}";

    document.querySelectorAll('.add-to-cart').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        fetch(button.dataset.url, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + apiToken,
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            // Open your modal here and display the message
            alert(data.message);
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
