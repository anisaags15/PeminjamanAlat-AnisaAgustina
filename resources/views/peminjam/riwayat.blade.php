<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Peminjaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jml</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($riwayats as $r)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $r->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-bold">{{ $r->jumlah }} Unit</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $r->tanggal_pinjam }} s/d {{ $r->tanggal_kembali }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{-- Gunakan logika status yang sama seperti sebelumnya --}}
                                        @if ($r->status == 'menunggu')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">MENUNGGU</span>
                                        @elseif($r->status == 'disetujui')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">DISETUJUI</span>
                                        @elseif($r->status == 'kembali')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">KEMBALI</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 uppercase">{{ $r->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada riwayat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>