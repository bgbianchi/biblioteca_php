<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Padrón de Lectores</h2>
    <a href="index.php?action=lectores_nuevo" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-semibold transition shadow-md flex items-center gap-2">
        <span>+</span> Nuevo Lector
    </a>
</div>

<div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Nombre Completo</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">DNI</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Email</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php foreach ($lectores as $lector): ?>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4 text-sm font-medium text-slate-800"><?php echo htmlspecialchars($lector['nombre']); ?></td>
                <td class="px-6 py-4 text-sm text-slate-500"><?php echo htmlspecialchars($lector['dni']); ?></td>
                <td class="px-6 py-4 text-sm text-slate-600 underline decoration-slate-200"><?php echo htmlspecialchars($lector['email']); ?></td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                    <a href="index.php?action=lectores_editar&id=<?php echo $lector['id']; ?>" class="text-emerald-600 hover:text-emerald-900 mr-4">Editar</a>
                    <a href="index.php?action=lectores_eliminar&id=<?php echo $lector['id']; ?>" 
                       onclick="return confirm('¿Confirma la eliminación de este lector?')"
                       class="text-red-600 hover:text-red-900">Borrar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-6 flex justify-between">
    <a href="index.php" class="text-slate-500 hover:text-slate-800 text-sm flex items-center gap-1">
        &larr; Volver a la Home
    </a>
</div>
