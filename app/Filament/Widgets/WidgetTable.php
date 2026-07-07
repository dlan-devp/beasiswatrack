<?php

namespace App\Filament\Widgets;

use App\Models\Scholarship;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class WidgetTable extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Daftar Beasiswa Ditutup';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Scholarship::query()->where('close_date', '<', today()))
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Beasiswa'),
                TextColumn::make('institution')
                    ->label('Penyelenggara'),
                TextColumn::make('requirements')
                    ->label('Persyaratan'),
                TextColumn::make('description')
                    ->label('Deskripsi'),
                TextColumn::make('open_date')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('close_date')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('application_link')
                    ->label('Link')
                    ->copyable(),
                TextColumn::make('type')
                    ->label('Jenis Beasiswa'),
                TextColumn::make('category')
                    ->label('Kategori'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label("Hapus"),
                ])->label("Option"),
            ])
            ->emptyStateHeading("Tidak Ada Beasiswa Yang Ditutup");
    }
}
