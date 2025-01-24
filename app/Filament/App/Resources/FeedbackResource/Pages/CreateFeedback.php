<?php

namespace App\Filament\App\Resources\FeedbackResource\Pages;

use App\Filament\App\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;
}
