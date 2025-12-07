<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Check-In Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Check-In Tiket</h2>

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('checkin.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="code" class="block text-gray-700 font-semibold mb-2">Kode Tiket</label>
                        <input type="text" name="code" id="code" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="Masukkan kode tiket..." required>
                    </div>

                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md transition">
                        Check-In Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
