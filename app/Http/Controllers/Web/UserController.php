<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'company_id', 'created_at')
            ->with('company:id,company_name')
            ->orderBy('created_at', 'desc')->get();
        return view('users', compact('users'));
    }
}

