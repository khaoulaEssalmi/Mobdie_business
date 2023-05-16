<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
    public function profile()
    {
        return view("backOffice.manager.settings");
    }

    public function updateGeneral(Request $request)
    {
        if ($request->input('button_clicked') == 'save_changes') {
            $request->validate([
                "full_name" => "required",
                "email" => "required",
                "address" => "max:255",
                "Phone" => "max:20",
            ],
                [
                    "full_name.required" => "le champ nom et Prenom est obligatoite",
                    "full_name.max" => "le champ nom et Prenom ne peut pas depasser 100 caracteres",

                    "email.required" => "le champ Email est obligatoite",
                    "email.email" => "le champ Email doit respecter la structure des emails",

                    "address.max" => "l'Address ne peut pas depasser 255 caracteres",

                    "Phone.max" => "le champ Phone ne peut pas depasser 20 caracteres",
                ]);

            $manager = User::find(auth()->user()->CIN);

            $manager->name = $request->input("full_name");
            $manager->email = $request->input("email");
            $manager->address = $request->input("address");
            $manager->phone = $request->input("phone");

            $manager->update();
            return redirect()->route("general.profile")->with(["success" => "Vos information general ont ete mises a jour avec succes"]);
        } elseif ($request->input('button_clicked') == 'cancel') {
            if(auth()->user()->isAdmin()){
                return redirect()->route("admin.dashboard");
            }
            if(auth()->user()->isSuperAdmin()){
                return  redirect()->route("superAdmin.dashboard");
            }
        }
    }

    public function resetPicture(Request $request)
    {

        $user = User::find(auth()->user()->CIN);

        if ($user->picture !== "avatar.png") {
            $path = public_path() . "\uploads\managers\avatars\\" . $user->picture;
            echo $path;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $user->picture = "avatar.png";
        $user->update();
        return redirect()->route("superAdmin.profile")->with(["success" => "Votre image de profile a ete mise a l'image par defaut"]);
    }

    public function changePicture(Request $request)
    {

        $user = User::find(auth()->user()->CIN);
        if ($user->picture !== "avatar.png") {
            $path = public_path() . "\uploads\managers\avatars\\" . $user->picture;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $user->picture = UploadController::userPic($request);

        $user->update();
        return redirect()->route("general.profile")->with(["success" => "Votre image de profile a ete mise a ajour par succes"]);
    }

    public function changePass(Request $request)
    {
        if ($request->input('button_clicked') == 'save_changes') {
            $user = User::find(auth()->user()->CIN);

            $request->validate([
                'password' => 'required',
                'new_pass_confirm' => 'required_with:new_pass|same:new_pass',
                'new_pass' => 'required|min:8',
            ]);

            if (!Hash::check($request->input("password"), $user->password)) {
                return redirect()->back()->withErrors(["password" => "merci de verifier votre mot de pass et de ressayer plus tard"]);
            }

            $user->password = Hash::make($request->input("new_pass"));

            $user->update();
            return redirect()->route("general.profile")->with(["success" => "Votre mot de pass a ete mis a ajour par succes"]);
        } elseif ($request->input('button_clicked') == 'cancel') {
            if(auth()->user()->isAdmin()){
                return redirect()->route("admin.dashboard");
            }
            if(auth()->user()->isSuperAdmin()){
                return  redirect()->route("superAdmin.dashboard");
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return  redirect("/");
    }
}
