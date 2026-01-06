<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Todo App</title>
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center cursor-pointer font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
        }

        .delete-btn {
            @apply bg-red-500 text-white hover:bg-red-700 transition duration-200
        }

        .link {
            @apply font-bold inline-block px-4 py-2 rounded text-sky-500 transition-shadow duration-200 hover:shadow-md hover:shadow-sky-800 mb-4
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-2 text-slate-700 leading-tight focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    @yield('styles')
</head>

<body class="container mx-auto mt-10 max-w-lg mb-10">
    <h1 class="text-2xl font-bold mb-2">@yield('title')</h1>
    <div x-data="{ flash: true }">

        @if (session()->has('success'))

        <div x-show="flash"
            class=" relative mb-10 rounded text-green-700 text-lg border-green-400 bg-green-100 px-4 py-3"
            role="alert">
            <span class="font-bold">Success!</span>
            <div>
                {{ session('success') }}
            </div>
            <span class="absolute right-0 top-0 px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    @click="flash = false" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        @endif
    </div>
    <div>@yield('content')</div>
</body>

</html>
