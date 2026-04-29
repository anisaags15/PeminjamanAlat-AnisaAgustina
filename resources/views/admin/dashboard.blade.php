<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Statistik Sistem (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Inventaris</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_inventaris'] }}</h3>
                    </div>
                    <div class="text-indigo-500">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.09-.36.14-.57.14s-.41-.05-.57-.14l-7.9-4.44A.991.991 0 013 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.09.36-.14.57-.14s.41.05.57.14l7.9 4.44c.32.17.53.5.53.88v9z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Menunggu Verifikasi</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['menunggu_verifikasi'] }}</h3>
                    </div>
                    <div class="text-orange-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"> Dipinjam</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['sedang_dipinjam'] }}</h3>
                    </div>
                    <div class="text-blue-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Peminjaman Selesai</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['selesai'] }}</h3>
                    </div>
                    <div class="text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>