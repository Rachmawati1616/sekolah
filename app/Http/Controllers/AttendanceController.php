<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::all();
        $selectedClassroomId = $request->input('classroom_id');
        $selectedDate = $request->input('date', date('Y-m-d'));

        $students = collect();
        $attendances = [];

        if ($selectedClassroomId) {
            $students = Student::where('classroom_id', $selectedClassroomId)->get();
            $attendancesData = Attendance::where('date', $selectedDate)
                ->whereIn('student_id', $students->pluck('id'))
                ->get()
                ->keyBy('student_id');

            foreach ($students as $student) {
                $attendances[$student->id] = $attendancesData->get($student->id);
            }
        }

        return view('attendances.index', compact('classrooms', 'selectedClassroomId', 'selectedDate', 'students', 'attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'attendances.*.notes' => 'nullable|string|max:255',
        ]);

        $date = $request->input('date');

        foreach ($request->input('attendances') as $studentId => $data) {
            Attendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $date],
                ['status' => $data['status'], 'notes' => $data['notes']]
            );
        }

        return redirect()->route('attendances.index', ['classroom_id' => $request->classroom_id, 'date' => $date])
            ->with('success', 'Presensi berhasil disimpan.');
    }
}
