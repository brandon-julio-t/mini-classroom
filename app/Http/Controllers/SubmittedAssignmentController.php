<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\SubmittedAssignment;
use Illuminate\Http\Request;

class SubmittedAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function create(Classroom $classroom)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom, SubmittedAssignment $submittedAssignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom, SubmittedAssignment $submittedAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom, SubmittedAssignment $submittedAssignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom, SubmittedAssignment $submittedAssignment)
    {
        //
    }
}
