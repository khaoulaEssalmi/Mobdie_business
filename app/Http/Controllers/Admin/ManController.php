<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ManController extends Controller
{
    ##################################### Profile begin ###################################################

    public function profile()
    {
        return view("backOffice.man.settings");
    }

    public function updateGeneral(Request $request) {
        if ($request->input('button_clicked') == 'save_changes')
        {
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
            return redirect()->route("superAdmin.profile")->with(["success" => "Vos information general ont ete mises a jour avec succes"]);
        }
        elseif ($request->input('button_clicked') == 'cancel') {
            return redirect()->route("superAdmin.dashboard");
        }
    }

    public function resetPicture(Request $request) {

        $user = User::find(auth("man")->user()->CIN);

        if ($user->picture !== "avatar.png"){
            $path = public_path() . "\uploads\managers\avatars\\" . $user->picture;
            echo $path;
            if(File::exists($path)) {
                File::delete($path);
            }
        }

        $user->picture  = "avatar.png";

        $user->update();
        return redirect()->route("superAdmin.profile")->with(["success" => "Votre image de profile a ete mise a l'image par defaut"]);
    }

    public function changePicture(Request $request) {

        $user = User::find(auth()->user()->CIN);
//dd($user);
        if ($user->picture !== "avatar.png"){
            $path = public_path() . "\uploads\managers\avatars\\" . $user->picture;
            if(File::exists($path)) {
                File::delete($path);
            }
        }

        $user->picture  = UploadController::userPic($request);

        $user->update();
        return redirect()->route("superAdmin.profile")->with(["success" => "Votre image de profile a ete mise a ajour par succes"]);
    }

    public function changePass(Request $request) {
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
            return redirect()->route("superAdmin.profile")->with(["success" => "Votre mot de pass a ete mis a ajour par succes"]);
        }
        elseif ($request->input('button_clicked') == 'cancel') {
            return redirect()->route("superAdmin.dashboard");
        }
    }

    #####################################  Profile end ###################################################


    public function display()
    {
//        $managers = User::where("role", "<>", "Admin")->get();
        $managers = User::where("role", "=", "Manager")->get();
        return view("backOffice.man.display", compact("managers"));
    }

    public function add()
    {
        return view("backOffice.man.add");
    }

    public function insert(Request $request)
    {
        if ($request->input('button_clicked') == 'validate') {
            $request->validate([
                "name" => "required|max:100,name",
                "cin" => "required|max:100|unique:users,CIN",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:8",
                "address" => "max:255",
                "phone" => "max:20",
            ],
                [
                    "name.required" => "le champ nom et Prenom est obligatoite",
                    "name.max" => "le champ nom et Prenom ne peut pas depasser 100 caracteres",
//                "name.unique"   => "cet utilisateur existe deja dans la base de donnees",

                    "cin.required" => "le champ nom et Prenom est obligatoite",
                    "cin.max" => "le champ nom et Prenom ne peut pas depasser 100 caracteres",
                    "cin.unique" => "cet CIN existe deja dans la base de donnees",

                    "email.required" => "le champ Email est obligatoite",
                    "email.email" => "le champ Email doit respecter la structure des emails",
                    "email.unique" => "cet email existe deja",

                    "password.required" => "le mot de passe est obligatoite",
                    "password.min" => "le mot de passe ne peut pas etre compose de moins de 8 caracteres",

                    "address.max" => "l'Address ne peut pas depasser 255 caracteres",

                    "phone.max" => "le champ Phone ne peut pas depasser 20 caracteres",
                ]);

            $user = new User();

            $user->name = $request->input("name");
            $user->CIN = $request->input("cin");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $user->address = $request->input("address");
            $user->phone = $request->input("Phone");
            $user->role = "Manager";
            $user->picture = $request->file('images') ? UploadController::userPic($request) : "avatar.png";

            $user->save();
            return redirect()->route("superAdmin.managers.display")->with(["success" => "vous avez ajoute votre man avec succes"]);
        }
        elseif ($request->input('button_clicked') == 'cancel') {
            return redirect()->route("superAdmin.managers.display");
        }
    }

    public function delete(Request $request)
    {
        $cin = request()->query('cin');
        $manager= User::where('CIN', $cin)->first();
        $image_path = public_path("uploads/managers/avatars/{$manager->picture}");
        unlink($image_path);

        $manager->delete();

        return redirect()->route("superAdmin.managers.display")->with(["success" => "vous avez supprimer votre man avec succes"]);
    }

    public function changeRole(Request $request) {
        $manager = Manager::find($request->input("id"));
        $manager->role = $request->input("role");

        $manager->Update();
        return redirect()->route("admin.managers.display")->with(["success" => "Role modifie avec succes"]);
    }
}
