<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a href="#" class="flex items-center">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-8">
            <span class="text-xl font-bold ml-2 text-blue-600">Dental Clinic</span>
        </a>


        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
            <div class="flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">Services</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">About Us</a>
                <a href="/appointment" class="text-gray-700 hover:text-blue-500">Book now</a>

            </div>
        </div>


        <div class="hidden md:flex items-center space-x-4">
            <a href="http://tandarts-praktijk.test/app/login" class="text-blue-600 hover:text-blue-800">Login</a>
            <a href="http://tandarts-praktijk.test/app/register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
        </div>


        <div class="md:hidden">
            <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>


    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <a href="#" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Home</a>
        <a href="#" class="block text-gray-700 hover:text-blue-500 px-6 py-2">Services</a>
        <a href="#" class="block text-gray-700 hover:text-blue-500 px-6 py-2">About Us</a>
        <a href="http://tandarts-praktijk.test/app/login" class="block text-blue-600 hover:text-blue-800 px-6 py-2">Login</a>
        <a href="http://tandarts-praktijk.test/app/register" class="block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Register</a>
    </div>
</nav>

<script>

    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
