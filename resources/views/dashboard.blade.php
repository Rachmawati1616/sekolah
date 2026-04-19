<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-1 text-blue-100">Berikut adalah ringkasan data presensi SD Negeri Deyangan 2 untuk hari ini: {{ \Carbon\Carbon::parse($today)->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            <!-- General Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Total Students -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-indigo-500">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-500 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600">Total Siswa Terdaftar</p>
                            <p class="text-3xl font-semibold text-gray-700">{{ $totalStudents }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Classrooms -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-teal-500">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-teal-100 text-teal-500 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600">Total Kelas</p>
                            <p class="text-3xl font-semibold text-gray-700">{{ $totalClassrooms }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Attendance Stats -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Presensi Hari Ini</h4>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
                    
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <p class="text-sm font-medium text-green-600 mb-1">Hadir</p>
                        <p class="text-2xl font-bold text-green-700">{{ $statsToday['Hadir'] }}</p>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                        <p class="text-sm font-medium text-yellow-600 mb-1">Izin</p>
                        <p class="text-2xl font-bold text-yellow-700">{{ $statsToday['Izin'] }}</p>
                    </div>

                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                        <p class="text-sm font-medium text-orange-600 mb-1">Sakit</p>
                        <p class="text-2xl font-bold text-orange-700">{{ $statsToday['Sakit'] }}</p>
                    </div>

                    <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                        <p class="text-sm font-medium text-red-600 mb-1">Alpa</p>
                        <p class="text-2xl font-bold text-red-700">{{ $statsToday['Alpa'] }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-600 mb-1">Belum Diabsen</p>
                        <p class="text-2xl font-bold text-gray-700">{{ $statsToday['BelumDiabsen'] }}</p>
                    </div>

                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Aksi Cepat</h4>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Input Presensi
                    </a>
                    
                    <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        Tambah Siswa Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
