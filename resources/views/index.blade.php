@extends('layouts.app')

@section('hero')
    <!-- Hero Section with a Placeholder Image -->
    <div class="relative bg-blue-600 text-white py-16 text-center">
        <img
            src="https://via.placeholder.com/1920x600"
            alt="Hero Banner"
            class="absolute inset-0 w-full h-full object-cover opacity-50"
        >
        <div class="relative z-10">
            <h1 class="text-5xl font-bold">Welcome to Our Dental Clinic</h1>
            <p class="mt-4 text-lg">Exceptional dental care for your whole family.</p>
            <a href="#" class="mt-6 inline-block bg-white text-blue-600 py-3 px-6 rounded-lg hover:bg-gray-200">
                Learn More
            </a>
        </div>
    </div>
@endsection

@section('content')
    <!-- Services Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            @foreach(['General Dentistry', 'Cosmetic Dentistry', 'Pediatric Dentistry'] as $service)
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <i class="fas fa-tooth text-4xl text-blue-600"></i>
                    <h3 class="mt-4 text-xl font-bold text-gray-700">{{ $service }}</h3>
                    <p class="mt-2 text-gray-500">Professional and personalized dental services.</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="md:col-span-12 mt-16 bg-gray-50 py-12">
        <h2 class="text-3xl font-bold text-center text-gray-800">What Our Patients Say</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['Excellent service', 'Highly recommend', 'Friendly staff'] as $testimonial)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="italic text-gray-600">"{{ $testimonial }}"</p>
                    <div class="mt-4 text-right">
                        <span class="text-sm font-bold text-gray-700">- John Doe</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Appointment Section -->
    <div class="md:col-span-12 mt-16 bg-blue-600 py-12 text-white text-center rounded-lg">
        <h2 class="text-3xl font-bold">Book Your Appointment Today!</h2>
        <p class="mt-4">
            Don’t wait, schedule your visit with one of our experienced dentists.
        </p>
        <a href="#" class="mt-6 inline-block bg-white text-blue-600 py-3 px-6 rounded-lg hover:bg-gray-200">
            Book Now
        </a>
    </div>

    <!-- FAQ Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Frequently Asked Questions</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                'What dental services do you offer?' => 'We offer a full range of dental services including cleanings, cosmetic dentistry, and more.',
                'How can I book an appointment?' => 'You can easily book an appointment through our website or by calling us directly.',
                'Do you accept insurance?' => 'Yes, we accept most insurance plans. Please contact us for more information.'
            ] as $question => $answer)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h4 class="font-bold text-lg">{{ $question }}</h4>
                    <p class="mt-2 text-gray-500">{{ $answer }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Blog Section -->
    <div class="md:col-span-12 mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Latest Blog Posts</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['The Importance of Regular Checkups', '5 Tips for Healthy Teeth', 'How to Choose a Dentist'] as $post)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h4 class="font-bold text-xl text-gray-700">{{ $post }}</h4>
                    <p class="mt-2 text-gray-500">
                        Discover valuable tips and insights to keep your smile healthy.
                    </p>
                    <a href="#" class="text-blue-600 mt-4 block hover:underline">Read more...</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
