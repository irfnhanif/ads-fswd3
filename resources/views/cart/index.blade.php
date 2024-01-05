<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-2xl">
                    @if ($cartItems->isEmpty())
                        <p class="my-4 text-lg text-gray-500 flex justify-center p-4">Empty Cart</p>
                    @else
                        <h2 class="text-4xl font-extrabold flex justify-center mt-4 mb-8">My Cart</h2>
                        @foreach ($cartItems as $cartItem)
                            <div tabindex="0" class="collapse collapse-open border border-base-300 bg-base-200"> 
                            <div class="collapse-title text-xl font-medium">
                                <div class="flex justify-between">
                                    <div class="text-3xl text-black">
                                        {{ $cartItem->products()->find($cartItem->product_id)->name }}
                                    </div>
                                    <div class="mt-2 text-2xl text-black">
                                        ${{ $cartItem->products()->find($cartItem->product_id)->price * $cartItem->quantity }}
                                    </div>
                                </div>
                            </div>
                            <div class="collapse-content"> 
                                <div class="flex justify-normal">
                                    <div>
                                        <form method="POST" action="{{ route('cart.update', ['cart_id' => $cartItem->id]) }}">
                                            @method('PUT')
                                            @csrf
                                            <label tabindex="0" class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Quantity</span>
                                                </div>
                                                <input tabindex="0" type="text" placeholder="Type here" name="quantity" value="{{ $cartItem->quantity }}" class="input input-bordered w-full max-w-xs" />
                                            </label>
                                    </div>
                                    <div class="mt-9">
                                        <input type="submit" value="Update" class="btn btn-outline  btn-primary ml-4" />
                                        </form>
                                    </div>
                                    
                                    </div>
                                    <div class="flex justify-between mt-3">
                                        <div>
                                            <form action="{{ route('cart.destroy', ['cart_id' => $cartItem->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline btn-error"> Delete
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <button data-url="{{ url('api/order/' . $cartItem->id) }}" class="btn btn-neutral add-to-order">Checkout</button>
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>