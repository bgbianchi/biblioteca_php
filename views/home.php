<?php
// views/home.php
// Este contenido se inyectará en la variable $content del layout.php
?>

<div class="max-w-5xl mx-auto py-12">
    <!-- Encabezado de Bienvenida -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl">
            Panel de Administración -v3.0.0-
        </h1>
        <p class="mt-4 text-lg text-slate-600">
            Bienvenido al sistema de gestión de biblioteca. Seleccione una entidad para comenzar a trabajar.
        </p>
    </div>

    <!-- Rejilla de Accesos CRUD -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Tarjeta Libros -->
        <a href="index.php?action=libros" class="group relative bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-indigo-500 rounded-t-2xl"></div>
            <div class="flex flex-col items-center">
                <div class="p-4 bg-indigo-50 rounded-full group-hover:bg-indigo-100 transition-colors">
                    <span class="text-4xl">📚</span>
                </div>
                <h2 class="mt-6 text-xl font-bold text-slate-800">Libros</h2>
                <p class="mt-2 text-slate-500 text-center text-sm">
                    Gestione el catálogo, autores y existencias de la biblioteca.
                </p>
                <span class="mt-6 text-indigo-600 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                    Acceder al CRUD <span>&rarr;</span>
                </span>
            </div>
        </a>

        <!-- Tarjeta Lectores -->
        <a href="index.php?action=lectores" class="group relative bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-emerald-500 rounded-t-2xl"></div>
            <div class="flex flex-col items-center">
                <div class="p-4 bg-emerald-50 rounded-full group-hover:bg-emerald-100 transition-colors">
                    <span class="text-4xl">👥</span>
                </div>
                <h2 class="mt-6 text-xl font-bold text-slate-800">Lectores</h2>
                <p class="mt-2 text-slate-500 text-center text-sm">
                    Administre el padrón de socios, sus datos y contacto.
                </p>
                <span class="mt-6 text-emerald-600 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                    Acceder al CRUD <span>&rarr;</span>
                </span>
            </div>
        </a>

        <!-- Tarjeta Préstamos -->
        <a href="index.php?action=prestamos" class="group relative bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-amber-500 rounded-t-2xl"></div>
            <div class="flex flex-col items-center">
                <div class="p-4 bg-amber-50 rounded-full group-hover:bg-amber-100 transition-colors">
                    <span class="text-4xl">📋</span>
                </div>
                <h2 class="mt-6 text-xl font-bold text-slate-800">Préstamos</h2>
                <p class="mt-2 text-slate-500 text-center text-sm">
                    Controle las salidas, devoluciones y disponibilidad de libros.
                </p>
                <span class="mt-6 text-amber-600 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                    Acceder al CRUD <span>&rarr;</span>
                </span>
            </div>
        </a>

    </div>

    <!-- Nota Informativa Inferior -->
    <div class="mt-16 bg-slate-100 border border-slate-200 rounded-xl p-6 flex items-start gap-4">
        <div class="text-slate-400">
            <svg xmlns="http://www.w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="text-sm text-slate-600">
            <p><strong>Recordatorio:</strong> El sistema aplica restricciones de integridad automáticamente. No podrá eliminar libros o lectores con préstamos activos para garantizar la consistencia de los datos.</p>
        </div>
    </div>
</div>
