<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'senha');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        $request->flashOnly('email');
        return back()->withErrors(['error' => 'E-mail ou senha incorretos.']);
    }

    public function logout(Request $request)
    {
        $usuario = Usuario::find(auth()->user()?->id);

        if (is_null($usuario)) {
            abort(410);
        }

        $request->session()->invalidate();

        Auth::logout();
        $usuario->save();

        return redirect('/login');
    }
}
