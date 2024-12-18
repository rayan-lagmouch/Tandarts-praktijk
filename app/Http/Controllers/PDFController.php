<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use PDF;

class PDFController extends Controller
{
    /**
     * Generate and download the PDF for a specific invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateInvoicePDF($id)
    {
        // Retrieve the invoice from the database
        $invoice = Invoice::with(['patient.person', 'treatment'])->findOrFail($id);

        // Pass data to the PDF view
        $data = [
            'invoice' => $invoice,
            'patientName' => $invoice->patient->full_name,
            'treatmentName' => $invoice->treatment->treatment_type ?? 'N/A',
            'date' => $invoice->date,
            'amount' => $invoice->amount,
            'status' => $invoice->status,
        ];

        // Load the view and generate the PDF
        $pdf = PDF::loadView('pdf.invoice', $data);

        // Return the PDF as a download
        return $pdf->download('invoice_' . $invoice->number . '.pdf');
    }
}
