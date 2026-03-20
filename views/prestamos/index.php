<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Gestión de Préstamos</h2>
    <a href="index.php?action=prestamos_nuevo" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition shadow-md flex items-center gap-2">
        <span>+</span> Registrar Salida
    </a>
</div>

<div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Libro</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Lector</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Salida</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Devolución</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php foreach ($prestamos as $p): ?>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4 text-sm font-medium text-slate-800"><?php echo htmlspecialchars($p['libro']); ?></td>
                <td class="px-6 py-4 text-sm text-slate-600"><?php echo htmlspecialchars($p['lector']); ?></td>
                <td class="px-6 py-4 text-sm text-slate-500"><?php echo $p['fecha_prestamo']; ?></td>
                <td class="px-6 py-4 text-sm">
                    <?php if ($p['fecha_devolucion']): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <?php echo $p['fecha_devolucion']; ?>
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 italic">
                            Pendiente
                        </span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                    <a href="index.php?action=prestamos_editar&id=<?php echo $p['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Registrar Devolución</a>
                    <a href="index.php?action=prestamos_eliminar&id=<?php echo $p['id']; ?>" 
                       onclick="return confirm('¿Eliminar registro de préstamo?')"
                       class="text-red-600 hover:text-red-900">Eliminar</a>
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
