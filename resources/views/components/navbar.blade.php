<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <!-- Logo Section -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-8">
            <span class="text-xl font-bold ml-2 text-blue-600">Smile Pro</span>
        </a>

        <!-- Centered Links -->
        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
            <div class="flex space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-500">Home</a>
                <a href="/services" class="text-gray-700 hover:text-blue-500">Services</a>
                <a href="/about" class="text-gray-700 hover:text-blue-500">About Us</a>
                <a href="/appointment" class="text-gray-700 hover:text-blue-500">Appointment</a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button class="flex items-center space-x-2 focus:outline-none" id="profile-menu-button">
                        <img src="{{ asset('images/default-avatar.png') }}"
                             alt="Profile"
                             class="h-8 w-8 rounded-full border border-gray-300">
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profile-menu" class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded hidden">
                        <!-- Conditional Link for Admin or Regular User -->
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                        @else
                            <a href="/app" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">User Dashboard</a>
                        @endif
                        <a href="/app/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="/app/logout"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="/app/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <!-- Guest Links -->
                <a href="/app/login" class="text-blue-600 hover:text-blue-800">Login</a>
                <a href="/app/register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <a href="/" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Home</a>
        <a href="/services" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Services</a>
        <a href="/about" class="block text-gray-700 hover:text-blue-500 px-6 py-2">About Us</a>

        @auth
            <div class="block text-gray-700 hover:text-blue-500 px-6 py-2">
                <!-- Admin/User Dashboard Link in Mobile Menu -->
                @if(auth()->user()->isAdmin())
                    <a href="/admin" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Admin Dashboard</a>
                @else
                    <a href="/app" class="block text-gray-700 hover:text-blue-500 px-6 py-2">User Dashboard</a>
                @endif
            </div>
            <a href="/app/profile" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Profile</a>
            <a href="/app/logout"
               class="block text-gray-700 hover:text-blue-500 px-6 py-2"
               onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                Logout
            </a>
            <form id="logout-form-mobile" action="/app/logout" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="/app/login" class="block text-blue-600 hover:text-blue-800 px-6 py-2">Login</a>
            <a href="/app/register" class="block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Register</a>
        @endauth
    </div>
</nav>

<script>
    // Dropdown menu toggle
    document.getElementById('profile-menu-button').addEventListener('click', () => {
        const menu = document.getElementById('profile-menu');
        menu.classList.toggle('hidden');
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
