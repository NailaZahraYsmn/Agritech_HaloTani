<?php

namespace App\Filament\Pages;

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

    public function table(Table $table): Table
    {
        return $table
            // Ambil semua keluhan, terbaru di atas
            // (nanti difilter per petani yang login)
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