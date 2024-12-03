<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <section class="flex items-center justify-center min-h-screen">
        <article class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
            <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Editar Tarea</h1>
            
            <form action="{{ route('editTask', $task->id) }}" method="POST" class="space-y-6">
            <!-- Método PUT para actualización -->
            @method('PUT')
            <!-- Token CSRF -->
            @csrf

            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="block text-gray-700">Título</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ $task->title }}" 
                    class="w-full px-4 py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-gray-500" 
                    required>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-gray-700">Descripción</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    class="w-full px-4 py-3 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-gray-500">{{ $task->description }}</textarea>
            </div>

            <!-- Category -->
            <div class="space-y-2">
                <label for="id_category" class="block text-gray-700">Categoría</label>
                <select 
                    name="id_category" 
                    id="id_category" 
                    class="w-full p-3 border-b-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500" 
                    required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $category->id == $task->id_category ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" 
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Volver al Dashboard</a>
                <button type="submit" 
                    class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Editar Tarea
                </button>
            </div>
        </form>

        </article>
    </section>

</body>
</html>
