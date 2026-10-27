<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- FontAwesome para los iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts oficiales de Laravel/Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Script rápido para manejar el modo oscuro sin parpadeos -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="h-full bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 flex flex-col justify-between transition-colors duration-300">

        <!-- Botón Superior Derecho para Dark/Light Mode -->
        <header class="w-full p-6 flex justify-end">
            <button 
                onclick="toggleDarkMode()" 
                class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 transition shadow-sm cursor-pointer"
                title="Cambiar modo oscuro/claro">
                <!-- Icono Sol (Se muestra en modo oscuro) -->
                <i class="fa-solid fa-sun hidden dark:inline-block text-amber-400"></i>
                <!-- Icono Luna (Se muestra en modo claro) -->
                <i class="fa-solid fa-moon inline-block dark:hidden text-gray-700"></i>
            </button>
        </header>

        <!-- Contenedor Principal (Logo + Buscador + Favoritos) -->
        <main class="flex flex-col items-center justify-center px-4 -mt-16">
            
            <!-- 1. Tu Logo o Título -->
            <div class="mb-8 text-center">
                <h1 class="text-5xl font-medium tracking-tight">
                    <span class="text-primary-600 dark:text-primary-400 font-bold">BPEJ</span>
                </h1>
            </div>

            <!-- 2. Barra de Búsqueda estilo Google -->
            <form action="https://www.google.com/search" method="GET" class="w-full max-w-xl mb-10">
                <div class="relative flex items-center">
                    <!-- Icono de lupa -->
                    <span class="absolute left-4 text-gray-400 dark:text-gray-500">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    
                    <!-- Input -->
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Buscar en Google o escribir una URL..." 
                        autocomplete="off"
                        autofocus
                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-full shadow-sm hover:shadow-md focus:shadow-md focus:outline-none focus:border-primary-500 dark:focus:border-primary-500 transition-all duration-200 text-base text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                    >
                </div>
            </form>

            <!-- 3. Círculos de Marcadores / Favoritos -->
            <div class="grid grid-cols-4 sm:grid-cols-8 gap-6 max-w-2xl">
                
                <!-- GitHub -->
                <a href="https://github.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-brands fa-github text-xl text-gray-700 dark:text-gray-200"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">GitHub</span>
                </a>

                <!-- Filament -->
                <a href="https://filamentphp.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-solid fa-f text-xl text-orange-500"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">Filament</span>
                </a>

                <!-- Laravel -->
                <a href="https://laravel.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-brands fa-laravel text-xl text-red-500"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">Laravel</span>
                </a>

                <!-- YouTube -->
                <a href="https://youtube.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-brands fa-youtube text-xl text-red-600"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">YouTube</span>
                </a>

                <!-- ChatGPT -->
                <a href="https://chatgpt.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-solid fa-brain text-xl text-emerald-500"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">ChatGPT</span>
                </a>

                <!-- Gmail -->
                <a href="https://mail.google.com" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-solid fa-envelope text-xl text-red-400"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">Gmail</span>
                </a>

                <!-- Debian -->
                <a href="https://debian.org" target="_blank" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 border border-gray-200/60 dark:border-gray-800/60 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2">
                        <i class="fa-brands fa-linux text-xl text-red-700"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">Debian</span>
                </a>

                <!-- Añadir -->
                <a href="#" class="flex flex-col items-center group">
                    <div class="w-14 h-14 bg-gray-100 dark:bg-gray-900 group-hover:bg-gray-200 dark:group-hover:bg-gray-800 rounded-full flex items-center justify-center shadow-sm transition-all duration-200 mb-2 border border-dashed border-gray-300 dark:border-gray-700">
                        <i class="fa-solid fa-plus text-sm text-gray-500"></i>
                    </div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate w-full text-center">Añadir</span>
                </a>

            </div>

        </main>

        <!-- Footer -->
        <footer class="py-4 text-center text-xs text-gray-400 dark:text-gray-600">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>

        <!-- Script del Botón Dark/Light -->
        <script>
            function toggleDarkMode() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
            }
        </script>
    </body>
</html>