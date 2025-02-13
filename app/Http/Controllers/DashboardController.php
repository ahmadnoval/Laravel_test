<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getStats(){
        // return redirect()->json([
            $total_users = User::count();
            $logged_in_users = User::where('status', true)->count();
            return view("dashboard", compact('total_users', 'logged_in_users'));
        // ]);
    }
}
