<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="font-semibold text-lg text-gray-800">
            Event Management
        </a>
        <div>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 mx-2">Dashboard</a>
            <a href="{{ route('checkin.result') }}" class="text-gray-600 hover:text-gray-800 mx-2">Check In</a>
        </div>
    </div>
</nav>
