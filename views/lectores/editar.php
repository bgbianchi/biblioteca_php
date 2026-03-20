<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Actualizar Perfil de Lector</h2>
    <form action="index.php?action=lectores_editar&id=<?php echo $id; ?>" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nombre</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($this->lector->nombre); ?>" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">DNI</label>
                <input type="text" name="dni" value="<?php echo htmlspecialchars($this->lector->dni); ?>" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($this->lector->email); ?>" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="index.php?action=lectores" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Cancelar</a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">Aplicar Cambios</button>
        </div>
    </form>
</div>
