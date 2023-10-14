@extends('layouts.main')

@section('content')

<div class="flex pt-20 justify-center ">
        
    <div class="aspect-w-16 aspect-h-9">
        <img class="w-full" src="https://thumbs.dreamstime.com/z/banner-rider-mountain-dirtbike-enduro-participates-motocross-jumps-springboard-against-background-dirt-concept-extreme-161644310.jpg" alt="image description">
    </div>
        
</div>

<div class="max-w-screen-xl mx-auto pt-5 dark:bg-gray-900">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mx-5 mb-10">
        
        {{-- <div class=" w-full min-h-full h-full max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 bg-[url('https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png')]">
            <div class="flex justify-center items-center h-full flex-col text-lg text-white font-medium">
                <h1>Custom</h1>
                <h2>Jacket</h2>
            </div>
        </div> --}}

        <figure class="relative max-w-sm h-full transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="#">
            <img class="rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-lg text-white bottom-2/4 justify-center mx-auto w-full">
                <h1 class="text-center text-xl font-medium">Custom</h1>
                <p class="text-center text-xl font-medium">Do you want</p>
            </figcaption>
        </figure>
        
        <figure class="relative max-w-sm h-full transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="#">
            <img class="rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-lg text-white bottom-2/4 justify-center mx-auto w-full">
                <h1 class="text-center text-xl font-medium">Custom</h1>
                <p class="text-center text-xl font-medium">Do you want</p>
            </figcaption>
        </figure>
        
        <figure class="relative max-w-sm h-full transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="#">
            <img class="rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png" alt="image description">
            </a>
            <figcaption class="absolute px-4 text-lg text-white bottom-2/4 justify-center mx-auto w-full">
                <h1 class="text-center text-xl font-medium">Custom</h1>
                <p class="text-center text-xl font-medium">Do you want</p>
            </figcaption>
        </figure>

    </div>

    {{-- product --}}
    <div class="flex flex-row justify-between items-center">
        <h1 class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Best <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Selling Product</span></h1>
        <a href="/shop" class="inline-flex text-xl items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">continue shoping<svg aria-hidden="true" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
    </div>

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
                        @if ($item->design_only === 1)
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

    {{-- galeri --}}
    
    <h2 class="text-4xl font-bold dark:text-white mt-32 mb-10">Ou'r Gallery</h2>
            
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
            </div>
        </div>
    </div>


</div>
    
@endsection