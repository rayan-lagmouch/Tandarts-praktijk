@extends('layouts.app')

@section('title', 'About Us')

@section('hero')
    <div class="relative bg-blue-600 text-white py-16 text-center">
        <img
            src="https://via.placeholder.com/1920x600"
            alt="About Us Banner"
            class="absolute inset-0 w-full h-full object-cover opacity-50"
        >
        <div class="relative z-10">
            <h1 class="text-5xl font-bold">About SmilePro Dental Clinic</h1>
            <p class="mt-4 text-lg">Delivering smiles with care and expertise.</p>
        </div>
    </div>
@endsection

@section('content')
    <!-- About Section -->
    <div class="md:col-span-12 bg-white p-8 rounded-lg shadow-md">
        <div class="text-center">
            <i class="fas fa-tooth text-6xl text-blue-600"></i>
            <h2 class="text-3xl font-bold text-blue-600 mt-4">Who We Are</h2>
            <p class="mt-4 text-gray-600">
                SmilePro Dental Clinic is dedicated to providing high-quality dental care tailored to your needs. Our expert team combines cutting-edge technology with a compassionate approach to ensure your oral health.
            </p>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="md:col-span-12 bg-blue-600 text-white p-8 mt-8 rounded-lg shadow-md">
        <div class="text-center">
            <i class="fas fa-bullseye text-6xl"></i>
            <h2 class="text-3xl font-bold mt-4">Our Mission</h2>
            <p class="mt-4">
                To enhance oral health and confidence by providing state-of-the-art dental solutions in a caring and professional environment.
            </p>
        </div>
    </div>

    <!-- Vision Section -->
    <div class="md:col-span-12 bg-white p-8 mt-8 rounded-lg shadow-md">
        <div class="text-center">
            <i class="fas fa-eye text-6xl text-blue-600"></i>
            <h2 class="text-3xl font-bold text-blue-600 mt-4">Our Vision</h2>
            <p class="mt-4 text-gray-600">
                To be a leader in dental care, setting the standard for excellence and innovation while creating smiles that inspire.
            </p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="md:col-span-12 bg-blue-600 text-white p-8 mt-8 rounded-lg shadow-md">
        <div class="text-center">
            <i class="fas fa-users text-6xl"></i>
            <h2 class="text-3xl font-bold mt-4">Meet Our Team</h2>
        </div>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['Dr. Emily Clark - Dentist', 'John Doe - Hygienist', 'Sarah Williams - Assistant'] as $member)
                <div class="bg-white text-center shadow-md rounded-lg p-6">
                    <img
                        src="https://via.placeholder.com/150"
                        alt="{{ $member }}"
                        class="mx-auto rounded-full w-24 h-24"
                    >
                    <h4 class="mt-4 font-bold text-blue-600">{{ $member }}</h4>
                    <p class="mt-2 text-gray-500">Dedicated to providing exceptional patient care.</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
