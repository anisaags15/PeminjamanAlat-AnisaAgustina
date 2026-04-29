<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tambah Kategori</h3>
                <form action="{{ route('admin.kategori.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori Baru" required
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md text-sm transition">
                        Tambah
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar Kategori</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($kategoris as $k)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $k->nama_kategori }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus kategori ini?')" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                        </form>

                                        <a href="{{ route('admin.kategori.edit', $k->id) }}" 
                                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium ml-2">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>