<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{
    public function login()
    {

        return view('backOffice.login');
    }

    public function index()
    {
        $cin = request()->query('cin');
        $nbrClients = 20;
        $nbrProducts = 10;
        $user = User::where('CIN', $cin)->first();
        return view('backOffice.dashboardSuperAdmin')->with(["nbrClients" => $nbrClients,"nbrProducts" => $nbrProducts,"user"=>$user]);
    }

    public function check(Request $request) {
        // inputs validation
        $request->validate([
            "email" => "required|email|exists:managers,email",
            "password" => "required|min:8"
        ],
        [
            "email.exists" => "cet email n'existe pas",
            "password.min" => "le mot de pass doit contenir plus de 8 character"
        ]);

        if(Auth::guard("admin")->attempt($request->only(["email", "password"]))){
            return redirect()->route("superAdmin.dashboard");
        }else{
            return redirect()->route("admin.login")->with("fail", "merci de verifier vos informations d'authentification");
        }
    }

    public function display()
    {
//        $managers = User::where("role", "<>", "Admin")->get();
        $managers = User::where("role", "=", "Admin")->get();
        return view("backOffice.manager.display", compact("managers"));
    }

}
