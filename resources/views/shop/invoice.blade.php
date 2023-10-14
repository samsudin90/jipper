<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Jipper - Invoice</title>
</head>
<body>
    <div class="h-screen mx-auto justify-center items-center flex">
        
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <span class="text-5xl font-extrabold tracking-tight mb-5 uppercase">{{ $order->status }}</span>
            <div class="flex items-baseline text-gray-900 dark:text-white">
                <span class="text-5xl font-semibold">$</span>
                <span class="text-5xl font-extrabold tracking-tight">{{ number_format($order->total_price) }}</span>
            </div>
            <h5 class="mt-4 text-lg font-medium text-gray-500 dark:text-gray-400">{{ $order->note }}</h5>
            <ul role="list" class="space-y-5 my-7">
                @foreach ($order->items as $item)
                <li class="flex space-x-3 items-center">
                    <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $item->product->nama }} sebanyak {{ $item->qty }}</span>
                </li>
                @endforeach
            </ul>
            <a href="/" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">back home</a>
        </div>
        
        </div>
</body>
</html>