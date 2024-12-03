<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Editar Categoría</h2>

        <!-- Formulario de edición -->
        <form action="{{ route('editCategory', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <!-- Especificamos que la solicitud es PUT -->

            <!-- Campo Nombre -->
            <label class="block">
                <span class="text-gray-700">Nombre</span>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Nombre de la categoría" class="w-full p-2 border border-gray-300 rounded-md" required>
            </label>

            <!-- Campo Descripción -->
            <label class="block">
                <span class="text-gray-700">Descripción</span>
                <textarea name="description" placeholder="Descripción de la categoría" class="w-full p-2 border border-gray-300 rounded-md" rows="5">{{ old('description', $category->description) }}</textarea>
            </label>

            <!-- Botón de envío -->
            <button type="submit" class="w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                Actualizar Categoría
            </button>
        </form>

        <!-- Botón de retorno -->
        <a href="{{ route('categories') }}" class="inline-block mt-4 p-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
            Regresar a Categorías
        </a>
    </div>

</body>
</html>
