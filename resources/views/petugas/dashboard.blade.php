<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Permintaan Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Tabel Daftar Permintaan Peminjaman --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar Permintaan Peminjaman</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjamans as $p)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $p->user->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $p->alat->nama_alat }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $p->tanggal_pinjam }} <span class="text-xs text-gray-400">s/d</span> {{ $p->tanggal_kembali }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($p->status == 'menunggu')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($p->status == 'disetujui')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Sedang Dipinjam
                                        </span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @elseif($p->status == 'kembali')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                        <div class="text-xs text-gray-400 mt-1">
                                            Kembali: {{ $p->tgl_dikembalikan }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Bagian Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($p->status == 'menunggu')
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('petugas.approve', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold transition">
                                                    ✓ TERIMA
                                                </button>
                                            </form>
                                            <form action="{{ route('petugas.reject', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold transition">
                                                    ✕ TOLAK
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($p->status == 'disetujui')
                                        <form action="{{ route('petugas.return', $p->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold transition">
                                                ↺ PROSES PENGEMBALIAN
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">- Selesai -</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 italic">
                                    Tidak ada permintaan peminjaman baru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>