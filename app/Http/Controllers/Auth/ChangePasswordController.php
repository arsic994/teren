<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $this->validateChangePassword($request);
        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('auth.password.change')
                ->withError('Uneli ste pogrešnu šifru!');
        }

        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();

        return redirect()->route('home')
            ->withSuccess('Uspešno ste promenili šifru!');
    }

    public function validateChangePassword(Request $request)
    {
        $messages = [
            'current-password.required' => 'Unesite trenutnu šifru',
            'password.confirmed' => 'Šifra mora da ima najmanje 6 karaktera',
        ];
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ], $messages);
    }
}
