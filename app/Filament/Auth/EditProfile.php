<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    protected function getNameFormComponent(): Component
    {
        return TextInput::make('nama')
            ->label('Nama lengkap')
            ->required()
            ->maxLength(100);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Profil')
                    ->description('Perbarui informasi data diri dan kata sandi Anda.')
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        TextInput::make('kontak')
                            ->label('Nomor kontak')
                            ->tel()
                            ->maxLength(20),
                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCurrentPasswordFormComponent(),
                    ])
                    ->columns(2)
                    ->inlineLabel(false),
            ]);
    }
}