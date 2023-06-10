<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\AnalystManager;
use App\Models\Manager;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class SuperAdminController extends Controller
{
    public function login()
    {

        return view('backOffice.login');
    }

    public function index()
    {
        $cin = request()->query('cin');
//        $count=request()->query('count');
        $adminCount = DB::table('users')
            ->where('role', 'Admin')
            ->where('etat', 1)
            ->count('Cin');

//        $nbrClients = 20;
//        $nbrProducts = 10;

        $user = User::where('CIN', $cin)->first();
        return view('backOffice.superAdmin.dashboardSuperAdmin')->with(["adminCount"=>$adminCount]);
    }

    public function displayAdmins(Request $request){
        $admins = DB::table('users')
            ->where('role', 'Admin')
            ->where('etat', 1)
            ->get();

//        dd($admins);

        return view('backOffice.superAdmin.displayAdmins')->with(["admins"=>$admins]);
    }

    public function addAdmin (Request $request){
        return view("backOffice.superAdmin.addAdmin");
    }

    public function addAdminSubmit(Request $request){

        if ($request->input('button_clicked') == 'validate') {
            $validator = Validator::make($request->all(), [
                "name" => "required|max:100,name",
                "cin" => "required|max:100|unique:users,CIN",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:8",
                "address" => "max:255",
                "phone" => "max:20",
            ],
                [
                    "name.required" => "The name field is required",
                    "name.max" => "Name field cannot exceed 100 characters",

                    "cin.required" => "The CIN field is required",
                    "cin.max" => "CIN field cannot exceed 100 characters",
                    "cin.unique" => "This CIN already exists in the database",

                    "email.required" => "The email field is required",
                    "email.email" => "The Email field must respect the structure of the emails",
                    "email.unique" => "This email already exists in the database",

                    "password.required" => "The password field is required",
                    "password.min" => "The password cannot be composed of less than 8 characters",

                    "address.max" => "The Address cannot exceed 255 characters",

                    "phone.max" => "The Phone field cannot exceed 12 characters",
                ]);
            $errors = $validator->errors();
            if ($errors->any()){
                return redirect()->back()->withErrors($errors);
            }


            $user = new User();

            $user->name = $request->input("name");
            $user->CIN = $request->input("cin");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $user->address = $request->input("address");
            $user->phone = $request->input("Phone");
            $user->role = "Admin";
            $user->etat=1;
            $user->picture = $request->file('images') ? UploadController::userPic($request) : "avatar.png";

            $user->save();

            $admins = User::where('role', 'Admin')
                ->where('etat', 1)
                ->get();

            Session::flash('success', 'user successfully adds');

            return view("backOffice.superAdmin.displayAdmins")->with(["admins"=>$admins]);
        } elseif ($request->input('button_clicked') == 'cancel') {
            $admins = User::where('role', 'Admin')
                ->where('etat', 1)
                ->get();
            return view("backOffice.superAdmin.displayAdmins")->with(["admins"=>$admins]);
        }
    }

    public function deleteAdmin(Request $request){
        $cin=request()->input('cin');
//        dd($cin);

        User::where('cin', $cin)->update(['etat' => 0]);

        Session::flash('success', 'Admin successfully deleted');

        $admins = DB::table('users')
            ->where('role', 'Admin')
            ->where('etat',1)
            ->get();
//dd($admins);
        return view("backOffice.superAdmin.displayAdmins")->with(["admins"=>$admins]);
    }
}
