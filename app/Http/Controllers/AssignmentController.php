<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function all()
    {
        return view('assignments.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Classroom $classroom)
    {
        return response()->setStatusCode(501);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Classroom $classroom)
    {
        return view('assignments.create', ['classroom' => $classroom]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classroom $classroom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function store(Request $request, Classroom $classroom)
    {
        if (Auth::user()->isStudent()
            || $classroom->teacher->id != Auth::user()->teacher->id) {
            return response()->setStatusCode(403);
        }

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'due' => 'required|date|after:today'
        ]);

        $assignment = new Assignment([
            'title' => $request['title'],
            'body' => $request['body'],
            'due' => $request['due'],
            'teacher_id' => Auth::user()->teacher->id
        ]);

        $classroom->assignments()->save($assignment);

        return redirect()->route('classrooms.show', $classroom->id)
            ->with('flash_message', 'Assignment posted. Please notify your students.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classroom $classroom
     * @param \App\Assignment $assignment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Classroom $classroom, Assignment $assignment)
    {
        return view('assignments.show', ['classroom' => $classroom, 'assignment' => $assignment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classroom $classroom
     * @param \App\Assignment $assignment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Classroom $classroom, Assignment $assignment)
    {
        return view('assignments.edit', ['classroom' => $classroom, 'assignment' => $assignment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classroom $classroom
     * @param \App\Assignment $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Classroom $classroom, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'due' => 'required|date|after:today'
        ]);

        Assignment::find($assignment->id)->update([
            'title' => $request['title'],
            'body' => $request['body'],
            'due' => $request['due'],
            'classroom_id' => $classroom->id
        ]);

        return redirect()->route('classrooms.show', ['classroom' => $classroom])
            ->with('flash_message', 'Assignment updated. Please notify your students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classroom $classroom
     * @param \App\Assignment $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classroom $classroom, Assignment $assignment)
    {
        Assignment::destroy($assignment->id);

        return redirect()->route('classrooms.show', ['classroom' => $classroom])
            ->with('flash_message', 'Assignment deleted. Your students shall rejoice!');
    }
}
