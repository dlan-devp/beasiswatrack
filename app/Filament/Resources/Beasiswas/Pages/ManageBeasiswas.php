<?php

namespace App\Filament\Resources\Beasiswas\Pages;

use App\Filament\Resources\Beasiswas\BeasiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBeasiswas extends ManageRecords
{
    protected static string $resource = BeasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
