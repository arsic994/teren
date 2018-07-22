<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\User;
use App\Source;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //Display a listing of the resource
    public function index(Request $request)
    {
        $users = User::all();

        return view('admin.users.index_users', compact('users'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('admin.users.create_user');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required|string|max:255',
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));

        if ($request->input('is_admin') == 'on') 
        {
            $user->is_admin = 1;
        }
        else {
            $user->is_admin = 0;
        }

        $user->save();

        return redirect('/admin/users')->with('Success'); 
    }

    //Show the form for editing the specified resource.
    public function edit($user_id)
    {
        $user = User::find($user_id);
        return view('admin.users.edit_user', compact('user'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $user_id)
    {
        $this -> validate($request, [
        'name' => 'required',
        ]);

        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ($request->input('is_admin') == 'on') 
        {
            $user->is_admin = 1;
        }
        else {
            $user->is_admin = 0;
        }

        $user->save();

        return redirect('/admin/users');
    }

    //Remove the specified resource from storage.
    public function delete($user_id)
    {
        $user = User::find($user_id);
        
        return view('admin.users.delete_user', compact('user'));
    }

    //Remove the specified resource from storage.
    public function destroy($user_id)
    {   
        User::find($user_id)->delete();
                
        return redirect('/admin/users');
    }
}


