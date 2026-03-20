<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">Alta de Lector</h2>
    <form action="index.php?action=lectores_nuevo" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nombre Completo</label>
                <input type="text" name="nombre" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">DNI / Identificación</label>
                <input type="text" name="dni" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
            </div>
        </div>
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="index.php?action=lectores" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Descartar</a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">Guardar Lector</button>
        </div>
    </form>
</div>
