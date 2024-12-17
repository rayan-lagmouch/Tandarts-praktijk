@extends('layouts.app')

@section('title', 'Our Services')

@section('hero')
    <div class="relative bg-blue-600 text-white py-16 text-center">
        <img
            src="https://via.placeholder.com/1920x600"
            alt="Services Banner"
            class="absolute inset-0 w-full h-full object-cover opacity-50"
        >
        <div class="relative z-10">
            <h1 class="text-5xl font-bold">Our Dental Services</h1>
            <p class="mt-4 text-lg">Comprehensive care tailored to your needs.</p>
        </div>
    </div>
@endsection

@section('content')
    <!-- Services Section -->
    <div class="md:col-span-12 bg-white p-8 rounded-lg shadow-md">
        <div class="text-center">
            <i class="fas fa-th-list text-6xl text-blue-600"></i>
            <h2 class="text-3xl font-bold text-blue-600 mt-4">Our Comprehensive Services</h2>
            <p class="mt-4 text-gray-600">We offer a wide range of dental care options to meet your needs.</p>
        </div>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['Checkups', 'fas fa-stethoscope', 'Routine exams to ensure healthy teeth and gums.'],
                ['Fillings', 'fas fa-fill-drip', 'Durable, natural-looking fillings for cavities.'],
                ['Teeth Cleaning', 'fas fa-broom', 'Professional cleaning to remove plaque and tartar.'],
                ['Orthodontics', 'fas fa-align-center', 'Advanced treatments to straighten your teeth.'],
                ['Root Canal', 'fas fa-medkit', 'Relieve pain and save infected teeth.'],
                ['Cosmetic Dentistry', 'fas fa-smile-beam', 'Smile makeovers with veneers, whitening, and more.']
            ] as [$title, $icon, $description])
                <div class="bg-blue-600 text-white shadow-md rounded-lg p-6 text-center">
                    <i class="{{ $icon }} text-4xl"></i>
                    <h4 class="mt-4 text-xl font-bold">{{ $title }}</h4>
                    <p class="mt-2">{{ $description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Call to Action -->
    <div class="md:col-span-12 bg-blue-600 text-white p-8 mt-16 rounded-lg shadow-md text-center">
        <i class="fas fa-calendar-check text-6xl"></i>
        <h2 class="text-3xl font-bold mt-4">Book Your Appointment Today!</h2>
        <p class="mt-4">
            Your journey to a healthier smile begins here. Contact us to schedule your visit.
        </p>
        <a href="/appointment" class="mt-6 inline-block bg-white text-blue-600 py-3 px-6 rounded-lg hover:bg-gray-200">
            Book Now
        </a>
    </div>
@endsection
