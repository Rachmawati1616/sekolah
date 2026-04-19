<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('classroom')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('students.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'nis' => 'required|string|unique:students,nis',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        return view('students.edit', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
