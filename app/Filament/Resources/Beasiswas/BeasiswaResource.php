<?php

namespace App\Filament\Resources\Beasiswas;

use App\Filament\Resources\Beasiswas\Pages\ManageBeasiswas;
use App\Models\Scholarship;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BeasiswaResource extends Resource
{
    protected static ?string $model = Scholarship::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;
    protected static ?string $recordTitleAttribute = 'List Beasiswa';
    protected static ?string $label = 'List Beasiswa';
    protected static ?string $navigationLabel = 'List Beasiswa';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label("Nama Beasiswa")
                    ->required(),
                TextInput::make('institution')
                    ->label("Penyelenggara")
                    ->placeholder("universitas Indonesia / ITB .....")
                    ->required(),
                Textarea::make('requirements')
                    ->label("Persyaratan")
                    ->placeholder("S1 minimal IPK 3.0, TOEFL 500+, ....")
                    ->required(),
                Textarea::make('description')
                    ->label("Deskripsi")
                    ->required(),
                DateTimePicker::make('open_date')
                    ->label("Tanggal Buka")
                    ->required(),
                DateTimePicker::make('close_date')
                    ->label("Tanggal tutup")
                    ->required(),
                TextInput::make('application_link')
                    ->label("Link")
                    ->required()
                    ->placeholder("Https://contoh.com/lamaran"),
                Select::make('type')
                    ->label("Jenis Beasiswa")
                    ->required()
                    ->placeholder("Pilih Jenis Beasiswa")
                    ->options([
                        'penuh' => 'Penuh',
                        'sebagian' => 'sebagian',
                    ]),
                Select::make('category')
                    ->label("Kategori")
                    ->required()
                    ->placeholder("Pilih category Beasiswa")
                    ->options([
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                        'D4' => 'D4',
                        'D3' => 'D3',
                        'D2' => 'D2',
                        'D1' => 'D1',
                        'SMA/SMK/MA' => 'SMA/SMK/MA',
                        'Lainnya' => 'Lainnya',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('List Beasiswa')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Beasiswa')
                    ->searchable(),
                TextColumn::make('institution')
                    ->label('Penyelenggara')
                    ->searchable(),
                TextColumn::make('requirements')
                    ->label('Persyaratan')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                TextColumn::make('open_date')
                    ->searchable()
                    ->toggleable(true),
                TextColumn::make('close_date')
                    ->searchable()
                    ->toggleable(true),
                TextColumn::make('application_link')
                    ->label('Link')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('type')
                    ->label('Jenis Beasiswa')
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable(),
            ])
            ->defaultPaginationPageOption(5)
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading("Tidak Ada Data Beasiswa");
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBeasiswas::route('/'),
        ];
    }
}
