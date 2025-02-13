<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loadAllUsers(){
        $all_users = User::all();
        return view("users",compact('all_users'));
    }

    public function loadAddUsersForm(){
        return view("add-user");
    }

    public function AddUser(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4|max:8',
        ]);
        try {
            $new_user = new User;
            $new_user->name = $request->full_name;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->save();

            return redirect('/users')->with('Success', 'User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('Fail', $e->getMessage());
        }
    }
    public function EditUser(Request $request) {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4|max:8',
        ]);

        try {
           $update_user = User::where('id', $request->user_id)->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => $request->password,
           ]);

            return redirect('/users')->with('Success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('Fail', $e->getMessage());
        }
    }


    public function loadEditForm($id) {
        $user = User::find($id);
        return view('edit-user', compact('user'));
    }


    public function deleteUser($id){
        try {
            User::where('id', $id)->delete();
            return redirect('/users')->with('success', 'User Deleted successfully');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }
}

