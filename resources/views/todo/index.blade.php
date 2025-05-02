<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center">
        <div class="w-full md:w-2/3 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            {{-- Notifikasi Sukses / Gagal --}}
            @if (session('success'))
                <div class="mb-4 text-green-600 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('danger'))
                <div class="mb-4 text-red-600 dark:text-red-400">
                    {{ session('danger') }}
                </div>
            @endif

            {{-- Tombol Create --}}
            <div class="mb-4">
                <a href="{{ route('todo.create') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded">
                    CREATE
                </a>
            </div>

            {{-- Tabel Todo --}}
            <table class="w-full table-auto text-left text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-2">
                                <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                    {{ $todo->title }}
                                </a>
                            </td>
                            <td class="px-4 py-2">
                            @if (!$todo->is_complete)
                                <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">
                                    OnGoing
                                </span>
                            @else
                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                    Completed
                                </span>
                            @endif
                            </td>
                            <td class="px-4 py-2">
                            <div class="flex space-x-4">
                                @if (!$todo->is_complete)
                                    <form action="{{ route('todo.complete', $todo) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:underline">Complete</button>
                                    </form>
                                @else
                                    <form action="{{ route('todo.uncomplete', $todo) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-600 hover:underline">Uncomplete</button>
                                    </form>
                                @endif
                                <form action="{{ route('todo.destroy', $todo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                No todos available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Delete All Completed --}}
            @if ($todosCompleted > 0)
                <div class="mt-6 text-center">
                    <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-6 py-2 rounded shadow">
                            DELETE ALL COMPLETED TASK
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
