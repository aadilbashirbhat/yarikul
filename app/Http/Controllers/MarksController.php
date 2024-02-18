<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SubjectMark;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('std_name', 'asc')->get();
        return view('marks-sheets.marks-sheet-list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marks-sheets.new-marks-sheet');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_name' => 'required|string|max:255',
                'registration_number' => 'required|string|max:255',
                'school_details' => 'required|string',
                'subjects' => 'required|array',
                'max_marks' => 'required|array',
                'marks_obtained' => 'required|array',
            ]);

            DB::beginTransaction();

            // Create a new student
            $student = Student::create([
                'std_name' => $validatedData['student_name'],
                'std_reg_no' => $validatedData['registration_number'],
                'school_details' => $validatedData['school_details'],
            ]);

            // Iterate through subjects and marks arrays / create subject marks
            for ($i = 0; $i < count($validatedData['subjects']); $i++) {
                $subject = $validatedData['subjects'][$i];
                $maxMarks = $validatedData['max_marks'][$i];
                $marksObtained = $validatedData['marks_obtained'][$i];

                // percentage
                $percentage = ($marksObtained / $maxMarks) * 100;

                // status
                $status = $percentage >= 40 ? 'Pass' : 'Fail';

                // Create SubjectMark record
                SubjectMark::create([
                    'student_id' => $student->id,
                    'subject_name' => $subject,
                    'max_marks' => $maxMarks,
                    'marks' => $marksObtained,
                    'percentage' => $percentage,
                    'status' => $status,
                ]);
            }

            DB::commit();

            return redirect()->route('marks.create')->with('success', 'Record Added successfully!');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->route('marks.create')->with('error', 'An error occurred while processing the form. Please try again.')->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('subjects')->findOrFail($id);
        $totalMarks = 0;
        foreach ($student->subjects as $subject) {
            $totalMarks += $subject->marks;
        }
        $grade = '';

        return view('marks-sheets.view-marks-sheet', compact('student', 'totalMarks', 'grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
