<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Peminjam') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- 1. BAGIAN ALERT --}}
            <div>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- 2. BAGIAN FORM & PENCARIAN ALAT --}}
            <section class="space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <h3 class="text-lg font-bold text-gray-900">Ajukan Peminjaman</h3>
                        <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama alat..." 
                                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full md:w-64">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">Cari</button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($alats as $alat)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-bold text-lg text-gray-800">{{ $alat->nama_alat }}</h4>
                                <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-2 py-1 rounded">Stok: {{ $alat->stok }}</span>
                            </div>
                            <form action="{{ route('pinjam.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                                
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Jumlah Pinjam</label>
                                    <input type="number" name="jumlah" min="1" max="{{ $alat->stok }}" value="1" required class="w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500">
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Tgl Pinjam</label>
                                        <input type="date" name="tanggal_pinjam" required class="w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Tgl Kembali</label>
                                        <input type="date" name="tanggal_kembali" required class="w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500">
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded text-sm hover:bg-indigo-700 transition">PINJAM</button>
                            </form>
                        </div>
                    @empty
                        <div class="bg-gray-50 border-2 border-dashed border-gray-200 p-10 rounded-lg text-center col-span-full">
                            <p class="text-gray-500">Alat tidak ditemukan atau stok kosong.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
</x-app-layout>