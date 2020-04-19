<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function enroll(Request $request)
    {
        $request->validate([
            'classroom_code' => 'required|string|exists:classrooms,code'
        ]);

        $user = Auth::user();

        if ($user->isStudent()) {
            $classroom = Classroom::where('code', $request['classroom_code'])->first();

            $user->student->classrooms()->attach($classroom);

            return redirect()->route('classrooms.index')->with('flash_message', 'Classroom added.');
        } else {
            return response()->setStatusCode(403);
        }
    }

    public function unenroll($classroom_id)
    {
        $user = Auth::user();

        if ($user->isStudent()) {
            $classroom = Classroom::find($classroom_id);

            $user->student->classrooms()->detach($classroom);

            return redirect()->route('classrooms.index')->with('flash_message', 'You just left a classroom.');
        } else {
            return response()->setStatusCode(403);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('classrooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return response()->setStatusCode(501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom_name' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        if ($user->isStudent()) {
            return response()->setStatusCode(403);
        } else {
            $classroom = new Classroom([
                'name' => $request['classroom_name'],
                'code' => Str::random()
            ]);

            $user->teacher->classrooms()->save($classroom);

            return redirect()->route('classrooms.index')->with('flash_message', 'Classroom created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('classrooms.show', ['classroom' => Classroom::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->setStatusCode(501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom_name' => 'required|string|max:255'
        ]);

        $classroom = Classroom::find($id);

        $classroom->name = $request['classroom_name'];

        $classroom->save();

        return redirect()->route('classrooms.index')->with('flash_message', 'Classroom updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Classroom::find($id)->delete();

        return redirect()->route('classrooms.index')->with('flash_message', 'Classroom deleted.');
    }
}
