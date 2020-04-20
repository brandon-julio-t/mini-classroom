<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\SubmittedAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmittedAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Assignment $assignment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Assignment $assignment)
    {
        // TODO: Show all assignments in this classroom for the teacher to download
        return view('submitted_assignments.index', ['assignment' => $assignment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Assignment $assignment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Assignment $assignment)
    {
        return view('submitted_assignments.create', ['assignment' => $assignment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Assignment $assignment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function store(Request $request, Assignment $assignment)
    {
        $request->validate([
            'answer' => 'required|file|mimes:pdf,docx,pptx,xlsx,zip'
        ]);

        if (Auth::user()->isStudent()) {
            $file = $request->file('answer');
            $filename = "{$assignment->classroom->name}_{$assignment->title}_" . Auth::user()->name;

            $path = $file->storeAs('public/answers', "{$filename}.{$file->extension()}");

            $query = SubmittedAssignment::where('assignment_id', $assignment->id)
                        ->where('student_id', Auth::user()->student->id);

            if ($query->exists()) {
                $query->first()->update(['path' => $path]);
            } else {
                SubmittedAssignment::create([
                    'path' => $path,
                    'created_at' => now(),
                    'student_id' => Auth::user()->student->id,
                    'assignment_id' => $assignment->id
                ]);
            }

            return redirect()->route('assignments.all')
                ->with('flash_message', 'Answer submitted.');
        } else {
            return response()->setStatusCode(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Assignment $assignment
     * @param \App\SubmittedAssignment $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment, SubmittedAssignment $submittedAssignment)
    {
        return response()->setStatusCode(501);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Assignment $assignment
     * @param \App\SubmittedAssignment $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment, SubmittedAssignment $submittedAssignment)
    {
        return response()->setStatusCode(501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Assignment $assignment
     * @param \App\SubmittedAssignment $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment, SubmittedAssignment $submittedAssignment)
    {
        return response()->setStatusCode(501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Assignment $assignment
     * @param \App\SubmittedAssignment $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment, SubmittedAssignment $submittedAssignment)
    {
        return response()->setStatusCode(501);
    }
}
