@extends('layouts.main')

@section('content')

    <div class="max-w-screen-xl mx-auto p-4 pt-20 h-screen">
        @if (!empty($user->orders))
        @foreach ($user->orders as $item)
            @if ($item->status === 'paid')
                
            @else
            <h1 class="text-3xl font-bold uppercase">perlu dibayar</h1>
            <div class="flex flex-row justify-between">
                <div class="">
                    <h1>{{ $item->note }}</h1>
                    <h1>{{ $item->total_price }}</h1>
                </div>
                <a href="/checkout/{{ $item->id }}">bayar</a>
            </div>
            @endif
        @endforeach
        
        @endif
        <div class="flex justify-center items-center flex-col gap-3 my-4">
            <h1 class="text-3xl font-bold uppercase">your cart</h1>
            <a href="/shop">continue shoping</a>
        </div>
        
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Material
                </th>
                <th scope="col" class="px-6 py-3">
                    Size
                </th>
                <th scope="col" class="px-6 py-3">
                    Qty
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0 ?>
            @if ($user)
                
            @forelse ($user->carts as $item)
            <?php $total += ($item->harga * $item->qty) ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-32 p-4">
                    <img src="{{ asset('storage/products/'.$item->product->images[0]->path ) }}" alt="Product">
                </td>
                @if ($item->design_only === 1)
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        Design : {{ $item->product->nama }}
                    </td>
                @else
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $item->product->nama }}
                    </td>
                @endif
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    @if (!isset($item->bahan))
                        -
                    @else
                        {{ $item->bahan }}
                    @endif
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{ $item['size'] }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <a href="/cart/decrement/{{ $item['id'] }}" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" >
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </a>
                        <div class="px-2 py-1 border-2 rounded-lg">
                            {{ $item->qty }}
                        </div>
                        <a href="/cart/increment/{{ $item['id'] }}" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" >
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    ${{ $item->harga }}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    ${{ $item->harga * $item->qty }}
                </td>
                <td class="px-6 py-4">
                    <form action="/cart/{{ $item['id'] }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    no data
                </tr>
            @endforelse

            @endif
        </tbody>
    </table>
</div>

    <form action="/checkout" method="post">
        @csrf
        <div class="flex flex-row justify-between mt-10">
            <div class="max-w-md w-full">
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add note order</label>
                <input type="text" name="note" value="-" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="">
                <p class="text-2xl font-semibold capitalize">subtotal : ${{ $total }}</p>
                <p>this is not include ...</p>
                <input type="hidden" name="total" value="{{ $total }}">
                @if (!$user)
                <!-- Modal toggle -->
                <a href="/login" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5" >
                    login first
                </a>
                @else
                @if (!$user->carts)
                <button type="submit" disabled class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">Checkout</button>
                @else
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">Checkout</button>
                @endif
            @endif
        </div>
    </div>
    </form>
    
    </div>
  
@endsection