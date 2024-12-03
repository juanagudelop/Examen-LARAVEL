<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 to-teal-500 h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-lg shadow-lg max-w-lg w-full text-center">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6">Bienvenido a Nuestro Sitio</h1>
        <p class="text-gray-600 mb-8">¡Nos alegra verte aquí! ¿Qué te gustaría hacer hoy?</p>

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end mb-4">
                @auth
                    <!-- Si el usuario está autenticado, mostramos el enlace a Dashboard -->
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                @else
                    <!-- Si no está autenticado, mostramos los botones de Log in y Register -->
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif

        <!-- Botones de Register y Log In con Tailwind CSS -->
        <div class="flex justify-between mb-4">
            <a href="{{ route('register') }}" class="w-1/2 bg-blue-500 text-white py-3 px-6 rounded-lg font-semibold text-lg hover:bg-blue-600 transition duration-300 ease-in-out text-center">Register</a>
            
            <div class="mx-2"></div>

            <a href="{{ route('login') }}" class="w-1/2 bg-teal-500 text-white py-3 px-6 rounded-lg font-semibold text-lg hover:bg-teal-600 transition duration-300 ease-in-out text-center">Log In</a>
        </div>
    </div>

</body>
</html>
