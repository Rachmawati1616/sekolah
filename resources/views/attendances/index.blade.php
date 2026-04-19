<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presensi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="GET" action="{{ route('attendances.index') }}" class="flex flex-col sm:flex-row items-end justify-between w-full space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="flex flex-col sm:flex-row items-end space-y-4 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                            <div class="w-full sm:w-48">
                                <x-input-label for="date" :value="__('Tanggal')" />
                                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="$selectedDate" required />
                            </div>

                            <div class="w-full sm:w-64">
                                <x-input-label for="classroom_id" :value="__('Kelas')" />
                                <select id="classroom_id" name="classroom_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" {{ $selectedClassroomId == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="w-full sm:w-auto">
                            <x-primary-button class="w-full sm:w-auto justify-center">
                                {{ __('Tampilkan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            @if($selectedClassroomId && $students->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('attendances.store') }}">
                        @csrf
                        <input type="hidden" name="date" value="{{ $selectedDate }}">
                        <input type="hidden" name="classroom_id" value="{{ $selectedClassroomId }}">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 mb-4">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan (Opsional)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($students as $index => $student)
                                        @php
                                            $attendance = $attendances[$student->id] ?? null;
                                            $status = old("attendances.{$student->id}.status", $attendance ? $attendance->status : 'Hadir');
                                            $notes = old("attendances.{$student->id}.notes", $attendance ? $attendance->notes : '');
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->nis }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <select name="attendances[{{ $student->id }}][status]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                                    <option value="Hadir" {{ $status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="Izin" {{ $status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                                    <option value="Sakit" {{ $status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                                    <option value="Alpa" {{ $status == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                                                </select>
                                                @error("attendances.{$student->id}.status")
                                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <x-text-input type="text" name="attendances[{{ $student->id }}][notes]" value="{{ $notes }}" class="w-full" placeholder="Keterangan..." />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Presensi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            @elseif($selectedClassroomId)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Tidak ada data siswa di kelas ini.
                                </p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tambah Siswa
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
