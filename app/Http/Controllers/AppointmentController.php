<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'employee_id' => 'required|exists:employees,id',  // Fix the field name here
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to book an appointment.');
        }

        // Create appointment
        Appointment::create([
            'patient_id' => $user->id,
            'employee_id' => $request->employee_id,  // Use 'employee_id' instead of 'employer_id'
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',  // You may want to keep 'pending' or adjust based on your status options
            'is_active' => true,  // Assuming the appointment is active by default
            'note' => $request->note,  // If the note field is optional, adjust as necessary
        ]);

        return redirect()->back()->with('success', 'Appointment successfully booked!');
    }
}
