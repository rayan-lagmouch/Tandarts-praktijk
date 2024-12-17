@extends('layouts.app')

@section('hero')
    <!-- Hero Section -->
    <div class="relative bg-blue-600 text-white py-16 text-center">
        <img
            src="https://via.placeholder.com/1920x600"
            alt="Hero Banner"
            class="absolute inset-0 w-full h-full object-cover opacity-50"
        >
        <div class="relative z-10">
            <h1 class="text-5xl font-bold">Welcome to SmilePro Dental Clinic</h1>
            <p class="mt-4 text-lg">Providing exceptional dental care for your whole family.</p>
            <a href="/services" class="mt-6 inline-block bg-white text-blue-600 py-3 px-6 rounded-lg hover:bg-gray-200">
                Explore Our Services
            </a>
        </div>
    </div>
@endsection

@section('content')
    <!-- Services Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Our Services</h2>
        <p class="mt-4 text-center text-gray-600">
            From routine cleanings to advanced cosmetic procedures, we’ve got you covered.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            @foreach([
                ['General Dentistry', 'fas fa-stethoscope', 'Comprehensive care for maintaining oral health.'],
                ['Cosmetic Dentistry', 'fas fa-smile-beam', 'Enhance your smile with advanced cosmetic solutions.'],
                ['Pediatric Dentistry', 'fas fa-child', 'Gentle dental care designed for children.']
            ] as [$title, $icon, $description])
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <i class="{{ $icon }} text-4xl text-blue-600"></i>
                    <h3 class="mt-4 text-xl font-bold text-gray-700">{{ $title }}</h3>
                    <p class="mt-2 text-gray-500">{{ $description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="md:col-span-12 mt-16 bg-blue-600 text-white py-12 rounded-lg">
        <h2 class="text-3xl font-bold text-center">What Our Patients Say</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                'Excellent service and friendly staff.',
                'Highly recommend SmilePro to anyone!',
                'The best dental care I’ve ever received.'
            ] as $testimonial)
                <div class="bg-white text-gray-700 shadow-md rounded-lg p-6 text-center">
                    <p class="italic text-gray-600">"{{ $testimonial }}"</p>
                    <div class="mt-4 text-right">
                        <span class="text-sm font-bold">- Jane Doe</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Appointment Call to Action -->
    <div class="md:col-span-12 mt-16 bg-blue-600 py-12 text-white text-center rounded-lg">
        <i class="fas fa-calendar-check text-6xl"></i>
        <h2 class="text-3xl font-bold mt-4">Book Your Appointment Today!</h2>
        <p class="mt-4">We’re ready to provide you with the care you deserve. Don’t wait!</p>
        <a href="/appointment" class="mt-6 inline-block bg-white text-blue-600 py-3 px-6 rounded-lg hover:bg-gray-200">
            Book Now
        </a>
    </div>

    <!-- FAQ Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Frequently Asked Questions</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                'What dental services do you offer?' => 'We provide cleanings, fillings, cosmetic procedures, and more.',
                'How can I book an appointment?' => 'You can book easily online or by giving us a call.',
                'Do you accept insurance?' => 'Yes, we accept most insurance plans. Contact us for more details.'
            ] as $question => $answer)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <i class="fas fa-question-circle text-4xl text-blue-600"></i>
                    <h4 class="font-bold text-lg mt-4">{{ $question }}</h4>
                    <p class="mt-2 text-gray-500">{{ $answer }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Blog Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Latest Blog Posts</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['The Importance of Regular Checkups', 'fas fa-calendar-alt', 'Discover why consistent dental exams are vital.'],
                ['5 Tips for Healthy Teeth', 'fas fa-heart', 'Simple yet effective ways to maintain your smile.'],
                ['How to Choose a Dentist', 'fas fa-user-md', 'Find the right dental professional for your needs.']
            ] as [$title, $icon, $description])
                <div class="bg-white shadow-md rounded-lg p-6">
                    <i class="{{ $icon }} text-4xl text-blue-600"></i>
                    <h4 class="font-bold text-xl text-gray-700 mt-4">{{ $title }}</h4>
                    <p class="mt-2 text-gray-500">{{ $description }}</p>
                    <a href="#" class="text-blue-600 mt-4 block hover:underline">Read more...</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
