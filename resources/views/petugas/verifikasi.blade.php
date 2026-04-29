<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verifikasi Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-500">User</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-500">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-500">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-bold uppercase text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($riwayats as $r)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $r->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $r->alat->nama_alat }} ({{ $r->jumlah }})</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $status = strtoupper($r->status);
                                    $color = $status == 'MENUNGGU' ? 'text-yellow-600' : ($status == 'DISETUJUI' ? 'text-blue-600' : 'text-green-600');
                                @endphp
                                <span class="font-black {{ $color }}">{{ $status }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Cek Status Pakai strtoupper biar aman dari typo huruf besar/kecil --}}
                                    @if(strtoupper($r->status) == 'MENUNGGU')
                                        <form action="{{ route('petugas.setujui', $r->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs transition">
                                                SETUJUI
                                            </button>
                                        </form>
                                        <form action="{{ route('petugas.tolak', $r->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs transition">
                                                TOLAK
                                            </button>
                                        </form>
                                    @elseif(strtoupper($r->status) == 'DISETUJUI')
                                        <form action="{{ route('petugas.kembali', $r->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-4 rounded text-xs transition">
                                                KEMBALIKAN ALAT
                                            </button>
                                        </form>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded text-xs font-bold italic">SELESAI</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>