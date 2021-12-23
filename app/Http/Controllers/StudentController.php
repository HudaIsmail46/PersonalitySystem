<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $student = Student::where('user_id', $id)->first();
        return view('student.profile', compact('student'));
    }


    public function register()
    {
        return view('student.register_student');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Student::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'student.actions')
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('student.index');
    }

    public function details($id)
    {
        
        // $students = student::orderBy('id', 'ASC')->paginate(50);

        return view('student.student_details', compact('id'));
    }

    public function storeDetails(Request $request, $id)
    {
        // dd($request->all());
        $this->validateCreatestudent();
        $student = new student;
        $student->fill([
            'matric_no' => $request->matric_no,
            'faculty' => $request->faculty,
            'department' => $request->department,
            'programme' => $request->programme,
            'year_in_progress' => $request->year_in_progress,
            'user_id' => $id,
        ]);
        // dd($student);
        $student->save();

        return redirect()->route('test.start');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validateCreatestudent();
        // $student = new student;
        // $student->fill([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone_no' => formatPhoneNo($request->phone_no),
        //     'password' => Hash::make($request->password)
        // ]);
        // $student->save();

        // return redirect()->route('student.show', $student->id)->with('student is created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // $all_roles = Role::all()->pluck('name');
        // return view('student.edit', compact('student', 'all_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // $roles = $request->roles;
        // $student->syncRoles($roles);
        // $this->validateUpdatestudent();
        
        // $student->fill([
        //     'name' => $request->name,
        //     'phone_no' => formatPhoneNo($request->phone_no)
        // ]);

        // $student->save();
        // return redirect()->route('student.show', $student->id)->with('student details updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // $student->delete();

        // return redirect()->route('student.index')->with('student is deleted.');
    }

    protected function validateCreateStudent()
    {
        return request()->validate([
            'matric_no' =>'required',
            'faculty' => 'required',
            'department' => 'required',
            'programme' => 'required',
            'year_in_progress' => 'required'
        ]);
    }

    protected function validateUpdateStudent()
    {
        return request()->validate([
            'name' => 'required',
            'phone_no' => 'required'
        ]);
    }
}
