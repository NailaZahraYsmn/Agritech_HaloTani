<x-filament-panels::page>
    <p style="color: #6b7280; font-size: 0.875rem; margin-top: -1.25rem;">
        Daftar konsultasi keluhan serta rekomendasi penanganan penyakit tanaman
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; align-items: start;">
        <x-filament::section>
            <p>Daftar Keluhan</p>
            <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                @foreach (['semua' => 'Semua', 'selesai' => 'Selesai', 'proses' => 'Proses'] as $key => $label)
                    <x-filament::button size="sm" wire:click="setFilter('{{ $key }}')" :color="$filter === $key  ? 'success' : 'gray'">
                        {{ $label }}
                    </x-filament::button>
                @endforeach
            </div>
            <p style="margin-top: 1rem; color: #6b7280;">Belum ada Keluhan</p>
        </x-filament::section> 
         
        <x-filament::section>
            <p>Detail Keluhan</p>
        </x-filament::section>
    </div>    
</x-filament-panels::page>
