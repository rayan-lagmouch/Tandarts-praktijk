<?php
namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Barryvdh\DomPDF\Facade\Pdf;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;
}
