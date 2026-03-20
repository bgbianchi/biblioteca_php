<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Bibliotecaria</title>
    <!-- Tailwind CSS para un diseño moderno -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    <!-- Navbar Superior -->
    <nav class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                        <span class="text-3xl">📖</span>
                        <span>BiblioGest</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="index.php" class="hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Inicio</a>
                        <a href="index.php?action=libros" class="hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Libros</a>
                        <a href="index.php?action=lectores" class="hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Lectores</a>
                        <a href="index.php?action=prestamos" class="hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Préstamos</a>
                    </div>
                </div>
                <div class="md:hidden">
                    <!-- Botón menú móvil (simplificado) -->
                    <span class="text-slate-500 text-sm">Menú</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-7xl">
        <!-- Área de Mensajes del Sistema -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="mb-6 p-4 rounded-lg border flex items-center gap-3 
                <?php 
                    if(in_array($_GET['msg'], ['success', 'updated', 'deleted'])) echo 'bg-emerald-50 border-emerald-200 text-emerald-800';
                    else echo 'bg-red-50 border-red-200 text-red-800';
                ?>">
                <span class="font-bold">Aviso:</span>
                <?php
                    $mensajes = [
                        'success'     => 'Registro creado correctamente.',
                        'updated'     => 'Información actualizada con éxito.',
                        'deleted'     => 'Registro eliminado del sistema.',
                        'restricted'  => 'No es posible eliminar: existen préstamos asociados a este registro.',
                        'unavailable' => 'El libro no está disponible para préstamo en este momento.',
                        'date_error'  => 'La fecha de devolución no puede ser anterior a la de préstamo.',
                        'error'       => 'Ocurrió un error al procesar la solicitud.'
                    ];
                    echo $mensajes[$_GET['msg']] ?? 'Acción procesada.';
                ?>
            </div>
        <?php endif; ?>

        <!-- Aquí se inyecta la vista específica -->
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6">
        <div class="text-center text-slate-500 text-sm">
            &copy; <?php echo date('Y'); ?> Sistema de Biblioteca MVC - Gestión Profesional.
        </div>
    </footer>

</body>
</html>
