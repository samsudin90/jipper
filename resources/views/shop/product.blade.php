@extends('layouts.main')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4 pt-20 h-screen">
        <h1 class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Introducing our latest product that will <span class="text-blue-600 dark:text-blue-500">change your life!</span></h1>
        <p class="font-normal text-gray-500 lg:text-lg dark:text-gray-400">Our product is the best because it’s made with high-quality materials that are built to last. It’s also designed with our customers in mind, so it’s easy to use and provides a great experience. With our product, you’ll be able to save time and money while getting the best results possible. Don’t miss out on this amazing opportunity to improve your life!</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 py-10 dark:bg-gray-900">
            @forelse ($product as $item)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="/shop/{{ $item->id }}">
                        <div class="h-96">
                            @if (count($item->images) != 0)
                                <img class="p-8 rounded-t-lg object-fill" src="{{ asset('storage/products/'.$item->images[0]->path ) }}" alt="product image" />
                            @else
                                <img class="p-8 rounded-t-lg object-fill" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="product image" />
                            @endif
                        </div>
                    </a>
                    <div class="px-5 pb-5">
                        <a href="/shop/{{ $item->id }}">
                            @if ($item->design_only === 1)
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white capitalize underline pb-2">Design : {{ $item->nama }}</h5>
                            @else
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white capitalize underline pb-2">{{ $item->nama }}</h5>
                            @endif
                        </a>
                        <div class="flex items-center justify-between">
                            @if ($design === 'yes')
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($item->harga_design) }}</span>
                            @else
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($item->harga) }}</span>
                            @endif
                            <a href="/shop/{{ $item->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buy now</a>
                        </div>
                    </div>
                </div>
            @empty
                <h2>no data</h2>
            @endforelse
    
        </div>

    </div>
@endsection