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
        <form class="space-y-6" action="/admin/design/image" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Add image for design <span class="text-xl font-bold uppercase">{{ $data->name }}</span></h5>
            
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="images">Upload multiple files</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="images" name="images[]" type="file" accept="image/*" multiple>
            <input type="hidden" name="design_id" value="{{ intval($data->id) }}">
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                <a href="/admin/design" class="text-blue-700 hover:underline dark:text-blue-500">Back</a>
            </div>
        </form>
    </div>

</div>
      
</body>
</html>