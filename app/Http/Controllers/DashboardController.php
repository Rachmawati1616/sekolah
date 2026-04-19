<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        // General Stats
        $totalStudents = Student::count();
        $totalClassrooms = Classroom::count();

        // Today's Attendance Stats
        $attendancesToday = Attendance::where('date', $today)->get();
        
        $statsToday = [
            'Hadir' => $attendancesToday->where('status', 'Hadir')->count(),
            'Izin' => $attendancesToday->where('status', 'Izin')->count(),
            'Sakit' => $attendancesToday->where('status', 'Sakit')->count(),
            'Alpa' => $attendancesToday->where('status', 'Alpa')->count(),
            'BelumDiabsen' => $totalStudents - $attendancesToday->count(),
        ];

        return view('dashboard', compact('totalStudents', 'totalClassrooms', 'statsToday', 'today'));
    }
}
