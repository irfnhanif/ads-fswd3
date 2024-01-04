<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-4xl font-extrabold flex justify-center py-6">Create Product</h2>
                    <div class="">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('products.store', []) }}">
                            @csrf
                            <label class="form-control w-full pb-4 max-w-2xl">
                            <div class="label">
                                <span class="label-text">Name</span>
                            </div>
                            <input type="text" placeholder="Type here" name="name" class="input input-bordered  w-full" />
                            <div class="label">
                            </div>
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            </label>

                            <label class="form-control w-full pb-4 max-w-2xl">
                            <div class="label">
                                <span class="label-text">Description</span>
                            </div>
                                <textarea name="description" class="textarea textarea-bordered h-24" placeholder="Product's description"></textarea>
                            <div class="label">
                            </div>
                            @error('description')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            </label>

                            <label class="form-control w-full pb-4 max-w-2xl">
                            <div class="label">
                                <span class="label-text">Price</span>
                            </div>
                            <input type="text" placeholder="Type here" name="price" class="input input-bordered w-full" />
                            <div class="label">
                                <span class="label-text-alt">in decimal (Ex: 120.00)</span>
                            </div>
                            @error('price')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            </label>

                            <label class="form-control w-full pb-4 max-w-2xl">
                            <div class="label">
                                <span class="label-text">Image file</span>
                            </div>
                                <input type="file" name="image" class="file-input file-input-bordered w-full" />
                            @error('image')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            </label>

                            <div class="flex justify-end pt-4 ">
                                <input type="submit" class="btn btn-neutral mr-5 " value="Save">
                                <a href="{{ route('products.index')}}" class="btn btn-ghost">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
