<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $existingInvoice = DB::table('invoices')->where('number', $data['number'])->first();

        if ($existingInvoice) {
            Notification::make()
                ->title('Duplicate Invoice Number')
                ->body('The invoice number "' . $data['number'] . '" is already in use. Please choose a unique number.')
                ->warning()
                ->send();

            throw new \RuntimeException('Duplicate invoice number detected.');
        }

        return parent::handleRecordCreation($data);
    }
}
