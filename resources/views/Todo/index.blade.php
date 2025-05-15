<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <x-create-button href="{{ route('todo.create') }}" />
                @if (session('success'))
                    <div class="text-green-600 dark:text-green-400 text-sm font-semibold px-4 py-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium">
                                        <a href="{{ route('todo.edit', $data) }}"
                                           class="text-gray-600 dark:text-gray-300 hover:underline text-sm">
                                            {{ $data->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (!$data->is_done)
                                            <span class="text-red-600">Ongoing</span>
                                        @else
                                            <span class="text-green-600">Completed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-4">
                                            {{-- Complete / Uncomplete --}}
                                            @if (!$data->is_done)
                                                <form action="{{ route('todo.complete', $data) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 dark:text-green-400 hover:underline">
                                                        Complete
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $data) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-blue-600 dark:text-green-400 hover:underline">
                                                        Uncomplete
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Delete --}}
                                            <form action="{{ route('todo.destroy', $data) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Delete semua Completed Task --}}
            @if ($todosCompleted > 1)
                <div class="flex justify-left pt-6">
                    <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button>
                            Delete All Completed Task
                        </x-primary-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>