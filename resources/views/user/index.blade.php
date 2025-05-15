<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Formulir Pencarian -->
                    <form method="GET" action="{{ route('user.index') }}" class="mb-4 flex space-x-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari pengguna..." 
                            class="w-full px-4 py-2 text-gray-300 bg-gray-800 rounded-lg focus:outline-none"
                            value="{{ request('search') }}"
                        />
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Cari
                        </button>
                    </form>

                    @if (session('success'))
                    <div class="text-green-600 dark:text-green-400 text-sm font-semibold px-4 py-2 flex justify-end">
                        {{ session('success') }}
                    </div>
                    @endif

                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-gray-400">
                        <thead class="text-xs uppercase bg-gray-800 text-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-center w-16">ID</th>
                                <th class="px-6 py-3 text-left">NAMA</th>
                                <th class="px-6 py-3 text-right">TODO</th>
                                <th class="px-6 py-3 text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $data)
                                <tr class="bg-gray-900 border-t border-gray-800">
                                    <td class="px-6 py-3 text-center">{{ $data->id }}</td>
                                    <td class="px-6 py-3 text-left">{{ $data->name }}</td>
                                    <td class="px-6 py-3 text-right">
                                        {{ $data->todos->where('is_done', true)->count() }} ({{ $data->todos->count() }})
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center">
                                            <div class="flex items-center gap-4">
                                                @if ($data->is_admin)
                                                    <form action="{{ route('user.removeadmin', $data) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-blue-600 dark:text-blue-400 whitespace-nowrap">
                                                            Remove Admin
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('user.makeadmin', $data) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                                            Make Admin
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('user.destroy', $data) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-gray-900">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada data tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                    <div class="flex items-center justify-end">
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>