<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Nuevo Préstamo</h2>
    <form action="index.php?action=prestamos_nuevo" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="mb-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Seleccionar Libro</label>
            <select name="libro_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                <option value="">-- Seleccione un ejemplar disponible --</option>
                <?php foreach ($libros as $l): ?>
                    <option value="<?php echo $l['id']; ?>"><?php echo htmlspecialchars($l['titulo']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Seleccionar Lector</label>
            <select name="lector_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                <option value="">-- Seleccione el lector --</option>
                <?php foreach ($lectores as $lec): ?>
                    <option value="<?php echo $lec['id']; ?>"><?php echo htmlspecialchars($lec['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-8">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Fecha de Préstamo</label>
            <input type="date" name="fecha_prestamo" value="<?php echo date('Y-m-d'); ?>" required 
                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="index.php?action=prestamos" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Cancelar</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">Confirmar Préstamo</button>
        </div>
    </form>
</div>
