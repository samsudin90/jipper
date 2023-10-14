<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Images - Add</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

    <div class="container flex flex-col justify-center h-screen items-center m-auto ">

    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="/admin/product/material" method="POST">
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Add Material for product <span class="text-xl font-bold uppercase">{{ $data->nama }}</span></h5>
            @foreach ($mat as $item)
                <div class="flex items-center mb-4">
                    @if (isset($data->materials[$loop->iteration-1]) && $item->id == $data->materials[$loop->iteration-1]->id)
                            <input name="materials[]" disabled checked id="default-checkbox" type="checkbox" value="{{ intval($item->id) }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        @else
                            <input name="materials[]" id="default-checkbox" type="checkbox" value="{{ intval($item->id) }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        @endif
                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->nama }}</label>
                </div>
            @endforeach
            <input type="hidden" name="product_id" value="{{ intval($data->id) }}">
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                <a href="/admin/product" class="text-blue-700 hover:underline dark:text-blue-500">Back</a>
            </div>
        </form>
    </div>

</div>
      
</body>
</html>