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
                        if (str_contains($state, 'Keluhan:')) {
                            return trim(str_replace("\n", ' ', explode('Keluhan:', $state)[1] ?? $state));
                        }
                        return trim($state);
                    })
                    ->limit(40)
                    ->searchable(),

                // 2. Tanaman (Support format \n dan format lama menyamping)
                TextColumn::make('jenis_tanaman')
                    ->label('Tanaman')
                    ->getStateUsing(function (Keluhan $record) {
                        if ($record->jenis_tanaman) return $record->jenis_tanaman;

                        if (preg_match('/Jenis Tanaman:\s*([^\n\r]+?)(?=\s*Lokasi:|\s*Urgensi:|\s*Keluhan:|\n|\r|$)/i', $record->teks_keluhan, $matches)) {
                            return trim($matches[1]);
                        }
                        return '-';
                    })
                    ->placeholder('-'),

                // 3. Urgensi (Support format \n dan format lama menyamping)
                TextColumn::make('tingkat_urgensi')
                    ->label('Urgensi')
                    ->getStateUsing(function (Keluhan $record) {
                        if ($record->tingkat_urgensi) return $record->tingkat_urgensi;

                        if (preg_match('/Urgensi:\s*([^\n\r]+?)(?=\s*Keluhan:|\n|\r|$)/i', $record->teks_keluhan, $matches)) {
                            return trim($matches[1]);
                        }
                        return '-';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower(trim($state))) {
                        'tinggi' => 'danger',  // Merah
                        'sedang' => 'warning', // Kuning / Oranye
                        'rendah' => 'info',    // Biru / Abu
                        default  => 'gray',
                    }),

                // 4. Tanggal
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // 5. Status
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match (strtolower(trim($state))) {
                        'selesai' => 'success',
                        'proses'  => 'warning',
                        default   => 'gray',
                    }),
            ]);
    }
}