<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User (Guru/Admin)
        User::factory()->create([
            'name' => 'Guru SD N Deyangan 2',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Buat Kelas (Kelas 1 - 6)
        $classes = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'];
        $classrooms = [];
        foreach ($classes as $className) {
            $classrooms[] = \App\Models\Classroom::create(['name' => $className]);
        }

        // 3. Buat Siswa untuk tiap kelas
        $nisCounter = 1000;
        $students = [];
        
        foreach ($classrooms as $classroom) {
            // Buat 5 siswa untuk setiap kelas
            for ($i = 1; $i <= 5; $i++) {
                $gender = (rand(0, 1) == 0) ? 'L' : 'P';
                $students[] = \App\Models\Student::create([
                    'classroom_id' => $classroom->id,
                    'nis' => (string) $nisCounter++,
                    'name' => "Siswa {$i} {$classroom->name}",
                    'gender' => $gender,
                ]);
            }
        }

        // 4. Buat Presensi untuk beberapa hari ke belakang (Misal: 3 hari lalu hingga hari ini)
        $statuses = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Izin', 'Sakit', 'Alpa']; // Bobot 'Hadir' lebih besar

        for ($i = 0; $i < 3; $i++) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            
            foreach ($students as $student) {
                // Pilih status acak
                $status = $statuses[array_rand($statuses)];
                
                $notes = null;
                if ($status == 'Izin') {
                    $notes = 'Ada acara keluarga';
                } elseif ($status == 'Sakit') {
                    $notes = 'Demam';
                }

                \App\Models\Attendance::create([
                    'student_id' => $student->id,
                    'date' => $date,
                    'status' => $status,
                    'notes' => $notes,
                ]);
            }
        }
    }
}
