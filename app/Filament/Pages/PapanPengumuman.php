<?php

namespace App\Filament\Pages;

use App\Models\Pengumuman;
use Filament\Pages\Page;

class PapanPengumuman extends Page
{

    // Tampilan Blade
    protected string $view = 'filament.pages.papan-pengumuman';

    // Mengirim data ke Blade
    protected function getViewData(): array
    {
        $kataKunci = request()->query('kata_kunci', '');
        $kataKunci = is_string($kataKunci) ? trim($kataKunci) : '';

        $pengumuman = Pengumuman::query()
            ->when($kataKunci !== '', function ($query) use ($kataKunci): void {
                $query->where(function ($query) use ($kataKunci): void {
                    $query->where('judul', 'like', "%{$kataKunci}%")
                        ->orWhere('isi', 'like', "%{$kataKunci}%");
                });
            })
            ->latest()
            ->get();

        return [
            'daftarPengumuman' => $pengumuman,
            'kataKunci' => $kataKunci,
        ];
    }
}
