<x-app-layout>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </head>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-
        200">
            {{ ('Todo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg
                dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('todo.store') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-6">
                            <x-input-label for="title" :value="('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ ('Save') }}</x-primary-button>
                            <a href="{{ route('todo.index') }}" class="inline-flex items-center px-4 py-2 text-xs fonst-
                            semibold tracking-widest
                            text-gray-700 uppercase transition duration-150 ease-in-out
                            bg-white border
                            border-gray-300 rounded-md shadow-sm dark:bg-gray-800
                            dark:border-gray-500
                            dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700
                            focus:outline-none focus:ring-2
                            focus:ring-indigo-500 focus:ring-ffset-2 dark:focus:ring-
                            offset-gray-800
                            disabled:opacity-25">{{ ('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>