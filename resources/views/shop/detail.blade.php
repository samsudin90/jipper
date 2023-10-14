@extends('layouts.main')

@section('content')

<form action="/cart" method="post" class="max-w-screen-xl mx-auto p-4 pt-20 h-screen">
    @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-24" >
            <div x-data="{id : 1}" class="grid gap-4" >
                @if (count($product->images) == 0)
                    <img x-data="image = 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg' " class="h-auto max-h-96 max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="img">
                    <input type="hidden" name="image" value="no">
                @else
                    <input type="hidden" name="image" value="{{ $product->images[0]->path }}">
                @endif
                @foreach ($product->images as $i)
                <div x-data="{
                    i : {{ @json_encode($loop->iteration) }}
                }" class="" x-bind:class="i == id ? '' : 'hidden' ">
                    <img class="h-auto max-w-md rounded-lg" src="{{ asset('storage/products/'.$i->path ) }}" alt="img">
                </div>
                @endforeach
                <div class="grid grid-cols-5 gap-4" ">
                    @foreach ($product->images as $item)
                    <div x-data="{
                        iteration : {{ @json_encode($loop->iteration) }}
                    }" x-on:click="id = iteration">
                        <img class="h-auto max-h-96 max-w-full rounded-lg hover:cursor-pointer hover:scale-110" src="{{ asset('storage/products/'.$item->path ) }}" alt="img">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col justify-start">
                @if ($product->design_only === 1)
                    <h2 class="text-4xl font-bold dark:text-white pb-2">Design : {{ $product->nama }}</h2>
                    <h6 class="text-xl dark:text-white">${{ number_format($product->harga_design) }}</h6>
                    <input type="hidden" name="price" value="{{ $product->harga_design }}">
                @else
                    <h2 class="text-4xl font-bold dark:text-white pb-2">{{ $product->nama }}</h2>
                    <h6 class="text-xl dark:text-white">${{ number_format($product->harga) }}</h6>
                    <input type="hidden" name="price" value="{{ $product->harga }}">
                @endif
                <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $product->deskripsi }}</p>
                <div class="flex gap-10">
                    <div class="w-1/2">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an size</label>
                        <select name="size" x-model="size" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option :value="size = 'M' ">M</option>
                            <option :value="size = 'L' ">L</option>
                            <option :value="size = 'XL' ">XL</option>
                            <option :value="size = 'XXL' ">XXL</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantities</label>
                        <input value=1 type="number" name="quantity" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                @if (count($product->bahans) != 0)
                <div class="" x-data="{id : 0}">
                    <div class=" pt-6">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select material</label>
                        <select name="material" x-model.number="id" x-model="material" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($product->bahans as $item)
                                <option :value="material = {{ @json_encode($item->nama) }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($product->bahans as $i)
                        <p x-data="{
                            i : {{ @json_encode($i->nama) }}
                        }" x-bind:class="material == i ? '' : 'hidden' " class="mb-3 text-gray-500 dark:text-gray-400 pt-3">{{ $i->deskripsi }}</p>
                    @endforeach
                </div>
                @endif
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="design" value="{{ $product->design_only }}">
                @if (empty($user))
                    <a href="/login" class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">Buy Now</a>
                @else
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">Buy Now</button>
                @endif
                    
            </div>
        </div>
    </div>
</form>
@endsection