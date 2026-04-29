<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tambah User</h3>
                <form action="{{ route('admin.user.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Lengkap" required
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    
                    <input type="email" name="email" placeholder="Email" required
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    
                    <input type="password" name="password" placeholder="Password" required
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    
                    <select name="role" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="peminjam">Peminjam</option>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md text-sm transition">
                        Tambah
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar User</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $u)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $u->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $u->email }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ ucfirst($u->role) }}</td> 
                                    <td class="px-4 py-2 text-right">
                                        <form action="{{ route('admin.user.destroy', $u->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                        </form>

                                        <a href="{{ route('admin.user.edit', $u->id) }}" 
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