@extends('layouts.app')

@section('hero')
@endsection

@if(Auth::check())
    <div class="container mx-auto mt-60 px-4 sm:px-6 lg:px-8 max-w-full md:max-w-2xl">
        <div class="bg-white shadow-2xl rounded-xl p-10 border border-gray-200">
            <h2 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Schedule Your Appointment</h2>
            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-8">
                @csrf

                <input type="hidden" name="patient_id" value="{{ Auth::id() }}">

                <div class="flex flex-col space-y-2">
                    <label for="employer_id" class="block text-gray-700 font-medium">Choose Your Desired Dentist</label>
                    <select id="employer_id" name="employer_id" class="form-select rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
                        @foreach(App\Models\Employee::all() as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="date" class="block text-gray-700 font-medium">Date</label>
                    <input id="date" type="date" name="date" min="{{ now()->toDateString() }}" class="form-input rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="time" class="block text-gray-700 font-medium">Time</label>
                    <select id="time" name="time" class="form-select rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
                        @foreach(['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'] as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg shadow-md">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                    Submit
                </button>
            </form>
        </div>
    </div>
@else
    <div class="container mx-auto mt-32 flex flex-col items-center">
        <div class="bg-gray-50 shadow-lg rounded-lg p-8 text-center max-w-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Access Restricted</h2>
            <p class="text-lg text-gray-600 mb-6">You need to be logged in to book an appointment.</p>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="container mx-auto mt-12 flex justify-center">
        <div class="bg-green-100 border border-green-400 text-green-700 p-6 rounded-lg shadow-lg">
            <p class="text-lg font-bold">{{ session('success') }}</p>
        </div>
    </div>
@endif
