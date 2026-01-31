<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input,
        textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>

    @livewireStyles
</head>

<body>

    @livewireScripts
    <section class="flex-col p-5">
        <div class="flex-col text-center">
            <h2 class="mb-4 text-2xl">Create Poll</h2>
            @livewire('create-poll')
        </div>
        <div class="flex-col text-center">
            <h2 class=" mb-4 mt-4 text-2xl font-bold">Available Polls</h2>
            @livewire('polls')
        </div>
    </section>

</body>

</html>
