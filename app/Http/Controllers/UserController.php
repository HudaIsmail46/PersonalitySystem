<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Spatie\Permission\Models\Role;

class UserController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->paginate(50);

        return view('user.index', compact('users'));
    }

    public function profile()
    {
        return view('user.profile');
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
            // 'phone_no' => formatPhoneNo($request->phone_no),
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
        // $all_roles = Role::all()->pluck('name');
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
        // $roles = $request->roles;
        // $user->syncRoles($roles);
        $this->validateUpdateUser();
        
        $user->fill([
            'name' => $request->name,
            // 'phone_no' => formatPhoneNo($request->phone_no)
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
            // 'phone_no' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
    }

    protected function validateUpdateUser()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|required',
            // 'phone_no' => 'required'
        ]);
    }
}
