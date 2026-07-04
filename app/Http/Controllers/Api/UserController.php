<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(
            User::select('id', 'name', 'email', 'role', 'company_id', 'created_at', 'updated_at')
                ->orderBy('created_at', 'desc')->get()
        );
    }

    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'role', 'company_id', 'created_at', 'updated_at')->findOrFail($id);
        return response()->json($user);
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password_hash'] = Hash::make($validated['password']);
        unset($validated['password']);
        $user = User::create($validated);
        return response()->json($user->only(['id', 'name', 'email', 'role', 'company_id', 'created_at']), 201);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        if (!empty($validated['password'])) {
            $validated['password_hash'] = Hash::make($validated['password']);
            unset($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return response()->json($user->only(['id', 'name', 'email', 'role', 'company_id', 'updated_at']));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'İstifadəçi silindi']);
    }
}

