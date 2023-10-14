<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Material - Edit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

    <div class="container flex flex-col justify-center h-screen items-center m-auto ">

    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="/admin/material/{{ $data->id }}" method="POST">
            @method("PUT")
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Update Material</h5>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Material Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="cotton" value="{{ $data->nama }}" required >
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Material Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>{{ $data->deskripsi }}</textarea>
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                <a href="/admin/material" class="text-blue-700 hover:underline dark:text-blue-500">Back</a>
            </div>
        </form>
    </div>

</div>
      
</body>
</html>