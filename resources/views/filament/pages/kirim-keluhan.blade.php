<x-filament-panels::page>
    <p style="color: #6b7280; font-size: 0.875rem; margin-top: -1.25rem;">
        Isi rincian kendala tanaman Anda untuk dianalisis oleh sistem AI
    </p>

    <form wire:submit="kirim">
        <x-filament::section>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">

                <div style="display: flex; flex-direction: column; gap: 1.25rem;">

                    <!-- Jenis Tanaman -->
                    <div>
                        <label style="font-weight: 600; color: #111827;">Jenis Tanaman</label>
                        <x-filament::input.wrapper :valid="! $errors->has('jenisTanaman')">
                            <x-filament::input 
                                type="text" 
                                wire:model="jenisTanaman" 
                                placeholder="Contoh: Padi, Cabai, Petai"
                                wire:loading.attr="disabled"
                                wire:target="kirim"
                            />
                        </x-filament::input.wrapper>
                        @error('jenisTanaman') <small style="color: #dc2626;">{{ $message }}</small> @enderror
                    </div>

                    <!-- Lokasi Lahan -->
                    <div>
                        <label style="font-weight: 600; color: #111827;">Lokasi Lahan</label>
                        <x-filament::input.wrapper :valid="! $errors->has('lokasiLahan')">
                            <x-filament::input 
                                type="text" 
                                wire:model="lokasiLahan" 
                                placeholder="Contoh: Magetan, Jawa Timur"
                                wire:loading.attr="disabled"
                                wire:target="kirim"
                            />
                        </x-filament::input.wrapper>
                        @error('lokasiLahan') <small style="color: #dc2626;">{{ $message }}</small> @enderror
                    </div>

                    <!-- Tingkat Urgensi -->
                    <div>
                        <label style="font-weight: 600; color: #111827;">Tingkat Urgensi</label>
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.25rem;">

                            @foreach (['Rendah', 'Sedang', 'Tinggi'] as $item)
                                <x-filament::button 
                                    type="button" 
                                    wire:click="$set('urgensi', '{{ $item }}')" 
                                    :color="$urgensi === $item ? 'success' : 'gray'"
                                    wire:loading.attr="disabled"
                                    wire:target="kirim">
                                    {{ $item }}
                                </x-filament::button>
                            @endforeach

                        </div>
                        @error('urgensi') <small style="color: #dc2626;">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Deskripsi Masalah -->
                <div>
                    <label style="font-weight: 600; color: #111827;">Deskripsi Masalah / Gejala</label>
                    <x-filament::input.wrapper :valid="! $errors->has('deskripsi')">
                        <textarea 
                            wire:model="deskripsi" 
                            rows="8" 
                            placeholder="Jelaskan kondisi tanaman secara detail..."
                            wire:loading.attr="disabled"
                            wire:target="kirim"
                            style="width: 100%; padding: 0.75rem; border: 0; background: transparent; outline: none; resize: none;"
                        ></textarea>
                    </x-filament::input.wrapper>
                    @error('deskripsi') <small style="color: #dc2626;">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Tombol Action & Loading State -->
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                    <x-filament::button 
                        type="submit" 
                        color="success"
                        wire:loading.attr="disabled"
                        wire:target="kirim"
                    >
                        <!-- Teks saat normal (dipaksa hide pas loading) -->
                        <span wire:loading.remove wire:target="kirim">
                            Kirim &amp; Analisis via AI
                        </span>

                        <!-- Teks & Spinner saat loading (default dipaksa display: none) -->
                        <span wire:loading wire:target="kirim" style="display: none;" class="items-center gap-2">
                            <svg class="animate-spin inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem; color: white;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Menganalisis dengan AI...</span>
                        </span>
                    </x-filament::button>
            </div>
        </x-filament::section>
    </form>
</x-filament-panels::page>