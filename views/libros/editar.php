<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Editar Libro</h2>
    <form action="index.php?action=libros_editar&id=<?php echo $id; ?>" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Título</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($this->libro->titulo); ?>" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Autores</label>
            <textarea name="autores" rows="3" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"><?php echo htmlspecialchars($this->libro->autores); ?></textarea>
        </div>
        <div class="flex justify-end gap-3">
            <a href="index.php?action=libros" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Regresar</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md">Actualizar Datos</button>
        </div>
    </form>
</div>
