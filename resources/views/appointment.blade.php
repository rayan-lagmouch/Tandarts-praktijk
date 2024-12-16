@extends('layouts.app')

@section('hero')
@endsection

@if(Auth::check())
    <div class="container mx-auto mt-60 px-4 sm:px-6 lg:px-8 max-w-full md:max-w-2xl">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Schedule Your Appointment</h2>
            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="patient_id" value="{{ Auth::id() }}">

                <div class="flex flex-col">
                    <label for="employer_id" class="block text-gray-600 font-medium mb-2">Choose Your Desired Dentist</label>
                    <select id="employer_id" name="employer_id" class="form-select rounded-lg border-gray-300" required>
                        @foreach(App\Models\Employee::all() as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="date" class="block text-gray-600 font-medium mb-2">Date</label>
                    <input id="date" type="date" name="date" min="{{ now()->toDateString() }}" class="form-input rounded-lg border-gray-300" required>
                </div>

                <div class="flex flex-col">
                    <label for="time" class="block text-gray-600 font-medium mb-2">Time</label>
                    <select id="time" name="time" class="form-select rounded-lg border-gray-300" required>
                        @foreach(['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'] as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                </div>

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 mb-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Submit</button>
            </form>
        </div>
    </div>
@else
    <div class="container mx-auto mt-16 text-center">
        <p class="text-lg text-gray-600">You need to be logged in to book an appointment.</p>
    </div>
@endif

@if(session('success'))
    <div class="container mx-auto mt-8 text-center">
        <div class="bg-green-500 text-white p-4 rounded-lg">
            <p class="text-lg font-semibold">{{ session('success') }}</p>
        </div>
    </div>
@endif
