<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Appointment Cancelled')
            ->view('emails.appointments.appointment-cancelled')
            ->with([
                'patientName' => $this->appointment->patient->full_name,
                'appointmentDate' => $this->appointment->date,
                'appointmentTime' => $this->appointment->time,
            ]);
    }
}
