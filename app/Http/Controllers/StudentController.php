<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // ginagamit to para maconnect sa file na to yung ginawang connection galing sa Models/Student.php


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return view('students.index', compact('student'));  //compact(students) means creating array to assign value of the $students

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:students',
            'age' => 'required|integer|min:1',
        ]);

        Student::create($validate);

        return redirect()->route('students.index')->with('success', 'Student created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail(($id));
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:students',
            'age' => 'required|integer|min:1',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validate);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}