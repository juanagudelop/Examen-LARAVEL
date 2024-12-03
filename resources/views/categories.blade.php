<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Layout del Navegador -->
    <header class="bg-gray-800 text-white py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <h2 class="font-semibold text-xl">Categorías</h2>
            <a href="{{ route('dashboard') }}" class="inline-block p-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Regresar al Dashboard
            </a>
        </div>
    </header>

    <!-- Contenedor principal -->
    <section class="px-6 py-12 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Formulario (Columna 1) -->
            <article class="col-span-1 bg-white p-6 rounded-lg shadow-md w-full">
                <h3 class="text-xl font-semibold mb-4">Agregar Nueva Categoría</h3>
                <form action="{{ route('createCategory') }}" method="POST" class="space-y-4">
                    @csrf
                    <label class="block">
                        <span class="text-gray-700">Nombre</span>
                        <input type="text" name="name" placeholder="Nombre de la categoría" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Descripción</span>
                        <textarea name="description" placeholder="Descripción de la categoría" class="w-full p-2 border border-gray-300 rounded-md" rows="5"></textarea>
                    </label>
                    <div class="mt-4">
                        <input type="submit" value="Guardar" class="w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 cursor-pointer">
                    </div>
                </form>
            </article>

            <!-- Tabla de categorías (Columna 2 y 3) -->
            <section class="col-span-2 bg-white p-6 rounded-lg shadow-md w-full">
                <h2 class="text-2xl font-semibold mb-4">Listado de Categorías</h2>
                <table class="min-w-full table-auto border-collapse bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Descripción</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ciclo para mostrar categorías -->
                        @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->description }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('showCategory', $category->id) }}" class="text-blue-500 hover:underline">Editar</a>
                                    <a href="{{ route('deleteCategory', $category->id) }}" class="text-red-500 hover:underline ml-4" onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </section>

    <!-- Script de Tailwind (para asegurar que los estilos se carguen correctamente) -->
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.js"></script>
</body>
</html>
