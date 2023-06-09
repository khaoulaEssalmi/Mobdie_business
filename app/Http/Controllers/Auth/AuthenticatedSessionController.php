<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $email=$request->email;
//        dd($email);
        $user = User::where('email', $request->email)->first();
//        dd($user);
        $count = DB::table('messages')
            ->where('Recepteur', function ($query) use ($email) {
                $query->select('CIN')
                    ->from('users')
                    ->where('email', $email);

            })
            ->where('State','=',1)
            ->count();
//        dd($count);

        $cin=$user->CIN;
        if ($user->isAdmin()) {
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard', ['cin' => $cin]);
        }

        if ($user->isAnalyst()) {
            Auth::guard('analyst')->login($user);
            return redirect()->route('analyst.dashboard', ['cin' => $cin]);
        }

        if ($user->isManager()) {
            Auth::guard('man')->login($user);

            return redirect()->route('manager.dashboard', ['cin' => $cin]);
        }

        if ($user->isSuperAdmin()){
//            dd('super admin');
            Auth::guard('super')->login($user);
            return redirect()->route('superAdmin.dashboard', ['cin' => $cin]);
        }

        return redirect()->route('superAdmin.dashboard');
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
