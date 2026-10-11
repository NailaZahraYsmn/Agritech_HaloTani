<x-filament-panels::page>
    <form wire:submit="submit">
        <x-filament::section>
            <!-- Grid 2 Kolom untuk Input -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                
                <!-- KOLOM KIRI: Input Singkat -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <!-- Jenis Tanaman -->
                    <div>
                        <label style="font-size: 0.875rem; font-weight: 600; color: #374151; display: block; margin-bottom: 0.375rem;">
                            Jenis Tanaman
                        </label>
                        <x-filament::input.wrapper>
                            <x-filament::input 
                                type="text" 
                                wire:model="jenisTanaman" 
                                placeholder="Contoh: Padi, Cabai, Petai" 
                                required
                            />
                        </x-filament::input.wrapper>
                    </div>

                    <!-- Lokasi Lahan -->
                    <div>
                        <label style="font-size: 0.875rem; font-weight: 600; color: #374151; display: block; margin-bottom: 0.375rem;">
                            Lokasi Lahan
                        </label>
                        <x-filament::input.wrapper>
                            <x-filament::input 
                                type="text" 
                                wire:model="lokasiLahan" 
                                placeholder="Contoh: Magetan, Jawa Timur" 
                                required
                            />
                        </x-filament::input.wrapper>
                    </div>

                    <!-- Tingkat Urgensi -->
                    <div>
                        <label style="font-size: 0.875rem; font-weight: 600; color: #374151; display: block; margin-bottom: 0.375rem;">
                            Tingkat Urgensi
                        </label>
                        <div style="display: flex; gap: 0.5rem;">
                            @foreach(['Rendah', 'Sedang', 'Tinggi'] as $level)
                                <x-filament::button
                                    type="button"
                                    size="sm"
                                    wire:click="setUrgensi('{{ $level }}')"
                                    :color="$urgensi === $level ? 'success' : 'gray'"
                                    :outlined="$urgensi !== $level">
                                    {{ $level }}
                                </x-filament::button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Textarea Deskripsi -->
                <div>
                    <label style="font-size: 0.875rem; font-weight: 600; color: #374151; display: block; margin-bottom: 0.375rem;">
                        Deskripsi Masalah / Gejala
                    </label>
                    <textarea 
                        wire:model="deskripsi" 
                        rows="7" 
                        placeholder="Jelaskan kondisi tanaman secara detail..."
                        style="width: 100%; border-radius: 0.5rem; border: 1px solid #d1d5db; padding: 0.625rem; font-size: 0.875rem;"
                        required
                    ></textarea>
                </div>

            </div>

                <!-- BARIS BAWAH: Tombol Submit di Kanan -->
                <div style="display: flex; justify-content: flex-end; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #f3f4f6;">
                <x-filament::button
                    type="submit"
                    color="success"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                >
                    <span wire:loading.remove wire:target="submit">
                        Kirim & Analisis dengan AI
                    </span>
                    <span wire:loading wire:target="submit">
                        Menganalisis dengan AI...
                    </span>
                </x-filament::button>
            </div>
        </x-filament::section>
    </form>
</x-filament-panels::page>