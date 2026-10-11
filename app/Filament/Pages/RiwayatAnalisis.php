<?php

namespace App\Filament\Pages;

use BackedEnum;
use App\Models\Keluhan;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class RiwayatAnalisis extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.riwayat-analisis';

    protected static ?string $title = 'Riwayat & Hasil Analisis AI';
    protected static ?string $navigationLabel = 'Riwayat Analisis';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';
    
    public string $filter='semua';
    public ?string $selectedId = null;

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }
    public function pilih(string $id): void
    {
        $this->selectedId = $id;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Keluhan::query())
            ->defaultSort('tanggal', 'desc')
            ->columns([
                TextColumn::make('tanggal')->date('d M Y')->sortable(),
                TextColumn::make('jenis_tanaman')->label('Tanaman')->searchable(),
                TextColumn::make('urgensi')->badge()->color('success'),
                TextColumn::make('status')->badge(),
                TextColumn::make('teks_keluhan')->label('Keluhan')->limit(50),
            ])
            ->recordActions([
                Action::make('lihat')
                    ->label('Lihat Hasil')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Hasil Analisis AI')
                    ->modalContent(fn (Keluhan $record) => new HtmlString(
                        nl2br(e($record->hasil_analisis ?? 'Belum ada hasil analisis.'))
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
            ]);
    }
}