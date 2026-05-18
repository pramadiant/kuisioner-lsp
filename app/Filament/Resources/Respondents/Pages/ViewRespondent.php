<?php

namespace App\Filament\Resources\Respondents\Pages;

use App\Filament\Resources\Respondents\RespondentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRespondent extends ViewRecord
{
    protected static string $resource = RespondentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
