<x-filament-panels::page>
    <div class="space-y-6">

        {{-- form cari pengumuman --}}
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-base font-semibold text-gray-800 mb-4">Cari Pengumuman</h3>
            
            <form action="{{ request()->url() }}" method="GET" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci: </label><br>
                    <input type="text" name="kata_kunci" value="{{ $kataKunci }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                        placeholder="Masukkan kata kunci...">
                </div>

                <hr>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow transition">
                    Cari Data
                </button>
            </form>
        </div>

        <div class="space-y-4">
            
            {{-- Perulangan untuk mengambil data dari Model --}}
            @foreach($daftarPengumuman as $item)
                
                @if($item->is_penting)
                    {{-- Penting --}}
                    <div class="p-4 rounded-xl border border-red-500 bg-red-50 shadow-sm">
                        <h3 class="text-lg font-bold text-red-700"> PENTING!--> {{ $item->judul }}</h3>
                        <p class="mt-2 text-red-900">{{ $item->isi }}</p>
                        <span class="text-xs text-red-500 mt-3 block">{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                @else
                    {{-- Biasa --}}
                    <div class="p-4 rounded-xl border border-gray-300 bg-white shadow-sm">
                        <h3 class="text-lg font-bold text-gray-800">Ada notifikasi buat kamu --> {{ $item->judul }}</h3>
                        <p class="mt-2 text-gray-600">{{ $item->isi }}</p>
                        <span class="text-xs text-gray-400 mt-3 block">{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                @endif

            @endforeach

            {{-- Menangani error visual jika database kosong --}}
            @if($daftarPengumuman->isEmpty())
                <div class="p-6 text-center rounded-xl border border-dashed border-gray-300 text-gray-500">
                    Belum ada pengumuman.
                </div>
            @endif

        </div>
    </div>
</x-filament-panels::page>