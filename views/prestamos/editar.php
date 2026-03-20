<div class="max-w-xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Registrar Devolución</h2>
    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mb-6 text-sm text-indigo-800">
        <p><strong>Libro:</strong> <?php echo htmlspecialchars($datos['libro_id']); // Aquí se podría mostrar el nombre con una consulta join previa ?></p>
        <p><strong>Fecha Salida:</strong> <?php echo $datos['fecha_prestamo']; ?></p>
    </div>
    
    <form action="index.php?action=prestamos_editar&id=<?php echo $id; ?>" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Fecha de Devolución Efectiva</label>
            <input type="date" name="fecha_devolucion" 
                   min="<?php echo $datos['fecha_prestamo']; ?>" 
                   value="<?php echo date('Y-m-d'); ?>" required 
                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <p class="mt-2 text-xs text-slate-500 italic">Debe ser igual o posterior a la fecha de préstamo.</p>
        </div>
        <div class="flex justify-end gap-3">
            <a href="index.php?action=prestamos" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Regresar</a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">Cerrar Préstamo</button>
        </div>
    </form>
</div>
