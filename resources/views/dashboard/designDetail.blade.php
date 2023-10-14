<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Design - Edit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @if(session('success'))
            <div id="toast-success" class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            @endif

    <div class="container grid grid-cols-1 lg:grid-cols-2 justify-center items-start m-auto py-5 gap-3">

        <div class="w-full max-w-4xl p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            
            <form class="space-y-6" action="/admin/design/{{ $data->id }}" method="POST">
                @method("PUT")
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Update Product</h5>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $data->name }}" required>
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Design Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>{{ $data->description }}</textarea>
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Design Price</label>
                    <input value="{{ $data->price }}" type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="12" required>
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300 pt-5 text-center">
                    <a href="/admin/design" class="text-blue-700 hover:underline dark:text-blue-500">Back</a>
                </div>
            </form>
            
        </div>

        <div class="w-full max-w-4xl p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 ">
            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Images</h3>
                @forelse ($data->images as $item)
                    <div class="flex flex-row justify-between items-center pb-5">
                        <img class="h-auto max-w-xs rounded-lg" src="{{ asset('storage/designs/'.$item->path) }}" alt="image description">
                        <form onsubmit="return confirm('Apakah anda yakin ingin menghapusnya ?');" action="/admin/design/image/{{ $item->id }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">delete</button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">There is no images for this design. <a href="/admin/design/image/{{ $data->id }}" class="font-semibold text-gray-900 underline dark:text-white decoration-indigo-500">Add some image</a></p>
                @endforelse
        </div>

    </div>
      
</body>
</html>