<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Panel de bienvenida -->
            <article class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6">
                <p class="text-gray-900 dark:text-gray-100 text-lg">
                    {{ __("You're logged in!") }}
                </p>
            </article>

            <!-- Contenedor con dos columnas: tabla y formulario -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-11/12 mx-auto">
                <!-- Formulario a la izquierda -->
                <section class="form-container bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6">
                    <div class="mb-4 text-right">
                        <!-- Botón de redirección a categorías -->
                        <a href="{{ route('categories') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Ir a Categorías
                        </a>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Add Task') }}
                    </h3>
                    <form method="POST" action="{{ route('createTask') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div class="space-y-1">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" name="title" id="title" required class="block w-full mt-1 p-3 rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <!-- Description -->
                            <div class="space-y-1">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" id="description" rows="3" class="block w-full mt-1 p-3 rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="space-y-1">
                            <label for="id_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="id_category" id="id_category" required class="block w-full mt-1 p-3 rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Add Task
                            </button>
                        </div>
                    </form>
                </section>

                <!-- Tabla a la derecha -->
                <section class="table-container bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 col-span-1 lg:col-span-1.5">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Task List') }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse bg-white rounded-lg shadow-md">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                    <th class="px-4 py-2 text-left">#</th>
                                    <th class="px-4 py-2 text-left">Title</th>
                                    <th class="px-4 py-2 text-left">Description</th>
                                    <th class="px-4 py-2 text-left">Category</th>
                                    <th class="px-4 py-2 text-left">Completed</th>
                                    <th class="px-4 py-2 text-left" colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                                        <td class="px-4 py-2 border-b text-sm text-gray-600 dark:text-gray-200">{{ $task->id }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-600 dark:text-gray-200">{{ $task->title }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-600 dark:text-gray-200">{{ $task->description }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-600 dark:text-gray-200">{{ $task->category->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-600 dark:text-gray-200">{{ $task->completed ? 'Yes' : 'No' }}</td>
                                        <td class="px-4 py-2 border-b">
                                            <a href="{{ route('showTask', $task->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Edit</a>
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            <a href="{{ route('deleteTask', $task->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200" onclick="confirm('¿Estas seguro de borrar esta tarea?')">Delete</a>
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            <form method="POST" action="{{ route('completeTask', $task->id) }}" onsubmit="return confirm('Mark task as completed?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-green-600 hover:text-green-800 transition duration-200">Mark as Done</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-gray-500">No tasks available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>
        </section>
    </section>
</x-app-layout>
    