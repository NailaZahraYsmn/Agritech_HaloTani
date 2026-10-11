<?php

namespace App\Filament\Pages;

use App\Models\Keluhan;
use App\Services\KiraAIService;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

class KirimKeluhan extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Kirim Keluhan';
    protected static ?string $title = 'Kirim Keluhan Tanaman';
    protected string $view = 'filament.pages.kirim-keluhan';
    public string $jenisTanaman = '';
    public string $lokasiLahan = '';
    public string $urgensi = 'Sedang'; // Default urgensi
    public string $deskripsi = '';

    public function kirim()
    {
        $this->validate([
            'jenisTanaman' => 'required|max:100',
            'lokasiLahan'  => 'required|max:150',
            'urgensi'      => 'required|in:Rendah,Sedang,Tinggi',
            'deskripsi'    => 'required|min:10',
        ]);

        // 1. Format rincian inputan form untuk kolom `teks_keluhan`
        $teksKeluhanLengkap = "Jenis Tanaman: {$this->jenisTanaman}\n" .
                              "Lokasi: {$this->lokasiLahan}\n" .
                              "Urgensi: {$this->urgensi}\n" .
                              "Keluhan: {$this->deskripsi}";

        // 2. Panggil AI Service V2
        $hasilAi = KiraAIService::generateSolusi($this->deskripsi,
            $this->lokasiLahan,$this->jenisTanaman
        );

        // 3. Simpan ke Database
        Keluhan::create([
            'id_keluhan'     => (string) Str::uuid(),
            'id_petani'      => auth()->id() ?? '01a11165-ec48-7296-ab63-1d1a601c3cec',
            'teks_keluhan'   => $teksKeluhanLengkap,
            'hasil_analisis' => $hasilAi,
            'tanggal'        => now(),
            'status'         => 'selesai',
        ]);

        Notification::make()
            ->title('Analisis AI Berhasil')
            ->body('Keluhan telah dianalisis dan disimpan ke riwayat.')
            ->success()
            ->send();

        $this->reset(['jenisTanaman', 'lokasiLahan', 'urgensi', 'deskripsi']);

        // Redirect ke Riwayat Analisis
        return redirect()->to('/petani/riwayat-analisis');
    }

    public function batal(): void
    {
        $this->reset(['jenisTanaman', 'lokasiLahan', 'urgensi', 'deskripsi']);
    }
}