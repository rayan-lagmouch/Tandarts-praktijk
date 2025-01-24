<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class wAppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'employer_id' => 'required|exists:employees,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to book an appointment.');
        }

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

