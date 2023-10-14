<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jipper - {{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Jipper</span>
        </a>
        <div class="flex md:order-2">
          @if (!$user)
          <a href="/login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
          <a href="/cart">
            @else
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">log out</button>
            </form>
            @endif 
            <a href="/cart">
              <div class="relative mt-1 ml-1">
                <svg  class="w-6 h-6 dark:text-white {{ $title === 'Cart'? 'text-blue-700' : '' }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                </svg>
                @if ($user)
                <span class="top-0 left-5 absolute  w-5 h-5 {{ $title === 'Cart'? 'bg-blue-700' : 'bg-gray-600' }} border-2 border-white dark:border-gray-800 rounded-full text-xs text-center text-white">{{ count($user->carts) }}</span>
                @endif
              </div>
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
          <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            {{-- <li>
              <a href="/" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
            </li> --}}
            <li>
              <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 {{ $title === 'design and manufacture' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Design and Manufacture <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
              <!-- Dropdown menu -->
              <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-4 text-sm text-gray-700 dark:text-gray-400 px-2" aria-labelledby="dropdownLargeButton">
                    <li class="">
                      <a href="/product/jersey" class="block py-2 pl-3 pr-4 {{ $title === 'jersey' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Jersey</a>
                    </li>
                    <li class="">
                      <a href="/product/polo" class="block py-2 pl-3 pr-4 {{ $title === 'polo' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Polo</a>
                    </li>
                    <li class="">
                      <a href="/product/caps" class="block py-2 pl-3 pr-4 {{ $title === 'caps' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Caps</a>
                    </li>
                    <li class="">
                      <a href="/product/jacket" class="block py-2 pl-3 pr-4 {{ $title === 'jacket' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Jacket</a>
                    </li>
                    <li class="">
                      <a href="/product/kits" class="block py-2 pl-3 pr-4 {{ $title === 'kits' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Kits</a>
                    </li>
                  </ul>
              </div>
            </li>
            <li>
              <button id="dropdownNavbarLinkDesign" data-dropdown-toggle="dropdownNavbarDesign" class="flex items-center justify-between w-full py-2 pl-3 pr-4 {{ $title === 'design only' ? "text-blue-700 dark:text-blue-500" : ($title === 'design only and manufactur' ? "text-blue-700 dark:text-blue-500" : "text-gray-900")  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Design Only <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
              <!-- Dropdown menu -->
              <div id="dropdownNavbarDesign" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-4 text-sm text-gray-700 dark:text-gray-400 px-2" aria-labelledby="dropdownLargeButton">
                    <li class="pb-3">
                      <a href="/design/bike wrap" class="block py-2 pl-3 pr-4 {{ $title === 'design only and manufactur' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Bike Wrap</a>
                    </li>
                    <li>
                      <a href="/design/canopy tent" class="block py-2 pl-3 pr-4 {{ $title === 'design only' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Canopy Tent</a>
                    </li>
                  </ul>
              </div>
            </li>
            <li>
              <a href="/size" class="block py-2 pl-3 pr-4 {{ $title === 'size guide' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Size Guide</a>
            </li>
            <li>
              <a href="/contact" class="block py-2 pl-3 pr-4 {{ $title === 'contact' ? "text-blue-700 dark:text-blue-500" : "text-gray-900"  }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
            </li>
          </ul>
        </div>
        </div>
      </nav>
    
      <div class="dark:bg-gray-900">
          @yield('content')
      </div>
  

      <footer class="bg-white dark:bg-gray-900 p-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <hr class="py-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:py-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="/" class="hover:underline">Jipper™</a>. Powered By <a href="https://flowbite.com/" target="_blank">Flowbite</a>.</span>
        </div>
    </footer>
    
    
</body>
@yield('js')

</html>