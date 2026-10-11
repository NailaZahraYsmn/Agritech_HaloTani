<x-filament-panels::page>
    <p style="color: #6b7280; font-size: 0.875rem; margin-top: -1.25rem;">
        Daftar konsultasi keluhan serta rekomendasi penanganan penyakit tanaman
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; align-items: start;">
        
        <!-- KOLOM KIRI: Daftar Keluhan -->
        <x-filament::section>
            <p style="font-weight: 600; font-size: 1rem; color: #111827;">Daftar Keluhan</p>
            
            <!-- Tombol Filter Status -->
            <div style="display: flex; gap: 0.5rem; margin-top: 1rem; margin-bottom: 1.25rem;">
                @foreach (['semua' => 'Semua', 'selesai' => 'Selesai', 'proses' => 'Proses'] as $key => $label)
                    <x-filament::button 
                        size="sm" 
                        wire:click="setFilter('{{ $key }}')" 
                        :color="$filter === $key ? 'success' : 'gray'">
                        {{ $label }}
                    </x-filament::button>
                @endforeach
            </div>

            <!-- List Card Keluhan -->
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @forelse ($this->keluhanList as $keluhan)
                    <div 
                        wire:click="pilih('{{ $keluhan->id_keluhan }}')"
                        style="padding: 0.875rem; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; border: 1px solid {{ $selectedId === $keluhan->id_keluhan ? '#10b981' : '#e5e7eb' }}; background-color: {{ $selectedId === $keluhan->id_keluhan ? '#f0fdf4' : '#ffffff' }};"
                    >
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: #6b7280; margin-bottom: 0.375rem;">
                            <span>{{ \Carbon\Carbon::parse($keluhan->tanggal)->format('d M Y H:i') }}</span>
                            <span style="text-transform: capitalize; font-weight: 600; padding: 0.125rem 0.5rem; border-radius: 0.25rem; background-color: {{ $keluhan->status === 'selesai' ? '#dcfce7' : '#fef3c7' }}; color: {{ $keluhan->status === 'selesai' ? '#15803d' : '#b45309' }};">
                                {{ $keluhan->status }}
                            </span>
                        </div>
                        <p style="font-size: 0.875rem; font-weight: 500; color: #111827; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $keluhan->teks_keluhan }}
                        </p>
                    </div>
                @empty
                    <p style="margin-top: 1rem; color: #6b7280; font-size: 0.875rem;">Belum ada Keluhan</p>
                @endforelse
            </div>
        </x-filament::section> 
         
        <!-- KOLOM KANAN: Detail & Hasil AI -->
        <x-filament::section>
            <p style="font-weight: 600; font-size: 1rem; color: #111827; margin-bottom: 1rem;">Detail Keluhan</p>

            @if ($this->selectedKeluhan)
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    
                    <!-- Informasi Rincian Input -->
                    <div style="padding: 1rem; background-color: #f9fafb; border-radius: 0.5rem; border: 1px solid #f3f4f6;">
                        <p style="font-weight: 600; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem;">Rincian Keluhan:</p>
                        <p style="white-space: pre-line; color: #1f2937; font-size: 0.875rem; line-height: 1.5;">{{ $this->selectedKeluhan->teks_keluhan }}</p>
                    </div>

                    <!-- Hasil Analisis AI V2 -->
                    <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #ffffff;">
                        <p style="font-weight: 600; font-size: 0.875rem; color: #16a34a; margin-bottom: 0.5rem;">Hasil & Rekomendasi AI:</p>
                        <div style="color: #1f2937; font-size: 0.875rem; line-height: 1.6;">
                            {!! nl2br(e($this->selectedKeluhan->hasil_analisis ?? 'Belum ada hasil analisis.')) !!}
                        </div>
                    </div>

                </div>
            @else
                <p style="color: #6b7280; font-size: 0.875rem;">Pilih salah satu keluhan di sebelah kiri untuk melihat detail hasil analisis AI.</p>
            @endif
        </x-filament::section>

    </div>    
</x-filament-panels::page>