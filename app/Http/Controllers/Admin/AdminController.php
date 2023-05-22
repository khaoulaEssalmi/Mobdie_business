<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\AnalystManager;
use App\Models\User;
use App\Models\Projet;
use App\Models\Manager;
use App\Models\Appel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $cin = request()->query('cin');
        $nbrClients = 2000;
        $nbrProducts = 9800;
        $user = User::where('CIN', $cin)->first();
        return view('backOffice.admin.dashboardAdmin')->with(["nbrClients" => $nbrClients, "nbrProducts" => $nbrProducts, "user" => $user]);
    }

    public function displayProjects()
    {
        $projects = Projet::all();
        return view("backOffice.admin.displayProjects", compact("projects"));
    }

    public function displayManagers()
    {
        $managers = User::where('role', 'Manager')
            ->where('etat', 1)
            ->get();
        return view("backOffice.admin.displayManagers", compact("managers"));
    }

    public function displayAnalysts()
    {
        $analysts = User::where('role', "Analyst")->get();
        return view("backOffice.admin.displayAnalysts", compact("analysts"));
    }

    public function affectationDesProjets()
    {
        $cin = request()->query('cin');
        $user = User::where('CIN', $cin)->first();
        $projects = DB::table('projets')
            ->whereNull('ManagerCIN')
            ->where('Statut', '=', 'En attente')
            ->get();
//        dd($projects);
        $totalProjects = Projet::where('managerCIN', $cin)->where('Statut', 'En cours')->count();
        return view('backOffice.admin.ProjectsManagers')->with(["projects" => $projects, "cin" => $cin, "user" => $user, "total" => $totalProjects]);
    }

    public function projectsSubmit(Request $request)
    {
        $cin = request()->query('cin');
        $user = auth()->user();

//        $user = User::where('cin', $cin)->first();
//        $totalProjects = Projet::where('managerCIN', $cin)->where('Statut','en cours')->count();

        $managers = User::where('role', "Manager")->get();
        $user = auth()->user();
        $adminCIN = $user->CIN;

        $selected_projects = $request->input('action');
        $projects = Projet::whereIn('ID', $selected_projects)->get();
        $selected_projects_array = $projects->toArray();
        $selected_projects_ids = array_column($selected_projects_array, 'ID');

        foreach ($selected_projects_ids as $project_id) {
//            dd($project_id);
            Projet::where('ID', $project_id)
                ->update([
                    'Statut' => 'En cours',
                    'AdminCIN' => $adminCIN,
                    'ManagerCIN' => $cin
                ]);

            $appel=new Appel();
            $appel->ProjetID=$project_id;
            $appel->save();
        }

        return view('backOffice.admin.displayManagers')->with(["success" => "Projets affected with success", "managers" => $managers]);
    }

    public function affectationQuota(Request $request)
    {
        $cin = request()->query('cin');
        $user = User::where('cin', $cin)->first();
        $nombreDeProjets = Projet::where('ManagerCIN', $cin)->where('statut', 'En cours')->count();
        $nombreDeProjets1 = Projet::where('ManagerCIN', $cin)->where('statut', 'Terminé')->count();
        $formateur = Manager::where('CIN', $cin)->first();
        $quota = $formateur->nb_max_des_appels;
        return view('backOffice.admin.quota')->with(['cin' => $cin, 'user' => $user, 'total' => $nombreDeProjets, 'total1' => $nombreDeProjets1, 'quota' => $quota]);
    }

    public function quotaChange(Request $request)
    {
        $cin = request()->query('cin');
        $user = Manager::where('cin', $cin)->first();
//        dd($user);
        $nb = $request->input("appels");
//        dd($nb);
        $user->update(['nb_max_des_appels' => $nb]);
        $managers = User::where('role', "Manager")->get();
        return view('backOffice.admin.displayManagers')->with(['managers' => $managers]);
    }

    public function affectationDesManagers(Request $request)
    {
        $cin = request()->query('cin');
        $analyst = User::where('CIN', $cin)->first();
//        $managers = DB::table('users')
//            ->where('role', '=', 'Manager')
//            ->get();
//        dd($managers);

        $excludedManagerCINs = DB::table('analyst_managers')
            ->where('AnalystCIN', $cin)
            ->pluck('ManagerCIN');
//        dd($excludedManagerCINs);

        $managers = DB::table('users')
            ->whereNotIn('CIN', $excludedManagerCINs)
            ->where('role', 'Manager')
//            ->pluck('CIN')
            ->get();
//        dd($managers);

        return view('backOffice.admin.ManagersAnalysts')->with(["managers" => $managers, "cin" => $cin, "analyst" => $analyst]);
    }

    public function managersSubmit(Request $request)
    {
        $cin = request()->query('cin');
//        dd($cin);
        $user = auth()->user();
//        dd($user);
        $selected_managers = $request->input('action');
        $managers = User::whereIn('CIN', $selected_managers)->get();
//        dd($managers);
        $selected_managers_cin_array = $managers->pluck('CIN')->toArray();
//        $selected_managers_ids = array_column($selected_managers_array, 'CIN');
//        dd($selected_managers_cin_array);
        foreach ($selected_managers_cin_array as $manager_id) {
            AnalystManager::create([
                'ManagerCIN' => $manager_id,
                'AnalystCIN' => $cin,
            ]);
        }
        $analysts = User::where('role', "Analyst")->get();
        return view("backOffice.admin.displayAnalysts", compact("analysts"));
    }

    public function ManagerProjects()
    {
        $cin = request()->query('cin');
//        dd($cin);
        $user = User::where('cin', $cin)->first();
        $projets = DB::table('projets')
            ->where('ManagerCIN', $cin)
            ->get();
        return view("backOffice.admin.displayManagerProjects")->with(['user' => $user, 'projects' => $projets]);


    }

    public function ManagerAnalysts()
    {
        $cin = request()->query('cin');
//        dd($cin);
        $user = User::where('cin', $cin)->first();
        $analysts = DB::table('users')
            ->whereIn('CIN', function ($query) use ($cin) {
                $query->select('AnalystCIN')
                    ->from('analyst_managers')
                    ->where('ManagerCIN', $cin);
            })
            ->get();
        return view("backOffice.admin.displayManagerAnalysts")->with(['user' => $user, 'analysts' => $analysts]);

    }

    public function deleteAnalyst()
    {
//        $cinMan= request()->query('cinMan');
//        dd($cinMan);
//        $cinAna=request()->query('cinAna');
//        dd($cinAna);
//        DB::table('analyst_managers')
//            ->where('ManagerCIN', 'cinMan')
//            ->where('AnalystCIN', 'cinAna')
//            ->delete();
    }

    public function addManager()
    {
        return view("backOffice.admin.addManager");
    }

    public function addManagerSubmit(Request $request)
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
            $user->etat=1;
            $user->picture = $request->file('images') ? UploadController::userPic($request) : "avatar.png";

            $user->save();

            $manager=new Manager();
            $manager->CIN=$request->input("cin");
            $manager->nb_max_des_appels=$request->input("Call");


            $manager->save();

            $managers = User::where('role', "Manager")->get();

            return view("backOffice.admin.displayManagers")->with(["success" => "vous avez ajoute votre man avec succes","managers"=>$managers]);
        } elseif ($request->input('button_clicked') == 'cancel') {
            return view("backOffice.admin.displayManagers");
        }
    }
}
