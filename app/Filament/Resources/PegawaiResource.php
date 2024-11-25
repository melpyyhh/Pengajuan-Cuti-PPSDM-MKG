<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\JenisCuti;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Data Pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Membuat grid dengan dua kolom
                Grid::make(2)->schema([
                    // Kolom pertama - Info Pegawai
                    TextInput::make('nama')
                        ->required()
                        ->label('Nama Pegawai')
                        ->columnSpan(2),
                    TextInput::make('nip')
                        ->required()
                        ->label('Nomor Induk Kepegawaian'),
                    TextInput::make('unitKerja')
                        ->required()
                        ->label('Unit Kerja'),
                    TextInput::make('jabatan')
                        ->required()
                        ->label('Jabatan'),
                    TextInput::make('masaKerja')
                        ->required()
                        ->label('Masa Kerja'),

                    // Kolom kedua - Jenis Cuti dan Jumlah Cuti
                    Repeater::make('cuti')
                        ->label('Jenis Cuti')
                        ->schema([
                            Select::make('jenis_cuti_id')
                                ->label('Jenis Cuti')
                                ->options(JenisCuti::all()->pluck('jenis_cuti', 'id'))
                                ->required(),

                            TextInput::make('jumlah_cuti')
                                ->label('Jumlah Cuti')
                                ->numeric()
                                ->minValue(0)
                                ->required(),
                        ])
                        ->createItemButtonLabel('Tambah Jenis Cuti')
                        ->columnSpan(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Pegawai'),
                TextColumn::make('nip')
                    ->label('Nomor Induk Kepegawaian'),
                TextColumn::make('unitKerja')
                    ->label('Unit Kerja')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }
}
