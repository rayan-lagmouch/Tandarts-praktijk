<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'employer_id' => 'required|exists:employees,id',
        ]);

        $user = Auth::user();

        // Check if user is logged in
        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to book an appointment.');
        }

        // Check if the selected employee is already booked for the same date and time
        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->where('employee_id', $request->employer_id)
            ->first();

        // If there's an existing appointment, show an error
        if ($existingAppointment) {
            return redirect()->back()->with('error', 'The selected employee is already booked at this date and time.');
        }

        // Create the appointment if no conflicts
        Appointment::create([
            'patient_id' => $user->id,
            'employee_id' => $request->employer_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment successfully booked!');
    }
}
