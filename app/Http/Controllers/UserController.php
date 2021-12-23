<?php

namespace App\Http\Controllers;

use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Spatie\Permission\Models\Permission;

class UserController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                        $btn = '<a href="\user\\'.$row->id.'" class="edit btn btn-info btn-sm">View</a>';
                        $btn = $btn.'<a href="\user\\'.$row->id.'\edit" class="edit btn btn-primary btn-sm ml-2">Edit</a>';

                         return $btn;
                 })
                 ->rawColumns(['action'])
                    ->make(true);
        }

        return view('user.index');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $staff = Staff::where('user_id', $id)->first();
        return view('user.profile', compact('user','staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCreateUser();
        $user = new User;
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        return redirect()->route('user.index')->with('User is created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $all_roles = Role::all()->pluck('name');
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $roles = $request->roles;
        $user->syncRoles($roles);
        $this->validateUpdateUser();
        
        $user->fill([
            'name' => $request->name,
        ]);

        $user->save();
        return redirect()->route('user.index')->with('User details updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('User is deleted.');
    }

    protected function validateCreateUser()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
    }

    protected function validateUpdateUser()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|required',
        ]);
    }
}
