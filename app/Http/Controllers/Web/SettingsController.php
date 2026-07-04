<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = $request->user();
        $user->update(['name' => $validated['name']]);
        return redirect()->route('settings')->with('success', 'Profil yeniləndi');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = $request->user();
        if (!Hash::check($validated['current_password'], $user->password_hash)) {
            return back()->withErrors(['current_password' => 'Cari şifrə yanlışdır']);
        }
        $user->update(['password_hash' => Hash::make($validated['password'])]);
        return redirect()->route('settings')->with('success', 'Şifrə dəyişildi');
    }
}

