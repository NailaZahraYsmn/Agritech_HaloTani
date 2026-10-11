<?php

namespace App\Filament\Widgets;

use App\Models\Keluhan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestKeluhanTable extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Keluhan::query()->latest('tanggal'))
            ->columns([
                // 1. Judul / Deskripsi (Bersihkan teks prefix)
                TextColumn::make('teks_keluhan')
                    ->label('Judul / Deskripsi')
                    ->formatStateUsing(function ($state) {
                        // Ambil teks setelah "Keluhan:" kalau ada
                        if (str_contains($state, 'Keluhan:')) {
                            return str_replace("\n", ' ', explode('Keluhan:', $state)[1] ?? $state);
                        }
                        return $state;
                    })
                    ->limit(40)
                    ->searchable(),

                // 2. Tanaman (Parse dari string jika kolom DB null, atau panggil jenis_tanaman)
                TextColumn::make('jenis_tanaman')
                    ->label('Tanaman')
                    ->getStateUsing(function (Keluhan $record) {
                        if ($record->jenis_tanaman) return $record->jenis_tanaman;
                        
                        // Fallback parse dari teks_keluhan jika data lama
                        preg_match('/Jenis Tanaman:\s*([^\n]+)/i', $record->teks_keluhan, $matches);
                        return $matches[1] ?? '-';
                    })
                    ->placeholder('-'),

                // 3. Urgensi (Parse dari string jika kolom DB null)
                TextColumn::make('tingkat_urgensi')
                    ->label('Urgensi')
                    ->getStateUsing(function (Keluhan $record) {
                        if ($record->tingkat_urgensi) return $record->tingkat_urgensi;

                        preg_match('/Urgensi:\s*([^\n]+)/i', $record->teks_keluhan, $matches);
                        return $matches[1] ?? '-';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'tinggi' => 'danger',
                        'sedang' => 'warning',
                        'rendah' => 'info',
                        default  => 'gray',
                    }),

                // 4. Tanggal
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // 5. Status dengan Badge Berwarna
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'selesai' => 'success',
                        'proses'   => 'warning',
                        default   => 'gray',
                    }),
            ]);
    }
}