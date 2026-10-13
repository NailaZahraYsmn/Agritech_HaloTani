<?php

namespace App\Filament\Pages;

use App\Models\Keluhan;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class RiwayatAnalisis extends Page
{
    protected string $view = 'filament.pages.riwayat-analisis';

    protected static ?string $title = 'Riwayat & Hasil Analisis AI';
    protected static ?string $navigationLabel = 'Riwayat Analisis';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    public string $filter = 'semua';
    public ?string $selectedId = null;

    public function mount(): void
    {
        $firstItem = $this->keluhanList->first();
        if ($firstItem) {
            $this->selectedId = $firstItem->id_keluhan;
        }
    }

    public function setFilter(string $filter): void
    {
        $this->filter = strtolower($filter);
        $firstItem = $this->keluhanList->first();
        $this->selectedId = $firstItem ? $firstItem->id_keluhan : null;
    }

    public function pilih(string $id): void
    {
        $this->selectedId = $id;
    }

    public function getKeluhanListProperty(): Collection
    {
        $idPetani = auth()->id() ?? '01a11165-ec48-7296-ab63-1d1a601c3cec';

        $query = Keluhan::where('id_petani', $idPetani)
            ->orderBy('tanggal', 'desc');

        if ($this->filter !== 'semua') {
            $query->where('status', $this->filter);
        }

        return $query->get();
    }

    public function getSelectedKeluhanProperty(): ?Keluhan
    {
        if (!$this->selectedId) {
            return $this->keluhanList->first();
        }

        return Keluhan::find($this->selectedId);
    }
}