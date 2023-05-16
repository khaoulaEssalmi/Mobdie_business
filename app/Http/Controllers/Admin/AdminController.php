<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Projet;
use App\Models\Formateur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('backOffice.dashboardAdmin')->with(["nbrClients" => $nbrClients,"nbrProducts" => $nbrProducts,"user"=>$user]);
    }

    public function displayProjects()
    {
        $projects = Projet::all();
        return view("backOffice.admin.displayProjects", compact("projects"));
    }

    public function displayManagers(){
        $managers=User::where('role',"Manager")->get();
        return view("backOffice.admin.displayManagers", compact("managers"));
    }

    public function displayAnalysts(){
        $analysts=User::where('role',"Analyst")->get();
        return view("backOffice.admin.displayAnalysts", compact("analysts"));
    }

    public function affectationDesProjets(){
        $cin = request()->query('cin');
        $user=User::where('CIN', $cin)->first();
        $projects = DB::table('projets')
            ->whereNull('ManagerCIN')
            ->where('Statut', '=', 'En attente')
            ->get();
//        dd($projects);
        $totalProjects = Projet::where('managerCIN', $cin)->where('Statut','En cours')->count();
        return view('backOffice.admin.ProjectsManagers')->with(["projects"=>$projects,"cin"=>$cin,"user"=>$user,"total"=>$totalProjects]);
    }

    public function projectsSubmit(Request $request){
        $cin = request()->query('cin');
        $user = auth()->user();

//        $user = User::where('cin', $cin)->first();
//        $totalProjects = Projet::where('managerCIN', $cin)->where('Statut','en cours')->count();

        $managers=User::where('role',"Manager")->get();
        $user = auth()->user();
        $adminCIN=$user->CIN;

        $selected_projects = $request->input('action');
        $projects = Projet::whereIn('ID', $selected_projects)->get();
        $selected_projects_array = $projects->toArray();
        $selected_projects_ids = array_column($selected_projects_array, 'ID');

        foreach ($selected_projects_ids as $project_id) {
            $project = Projet::where('ID', $project_id)->first();
            $project->ManagerCIN = $cin;
            $project->AdminCIN=$adminCIN;
            $project->Statut = 'En cours';
            $project->save();
        }

        return view('backOffice.admin.displayManagers')->with(["success" =>"Projets affected with success","managers"=>$managers]);
    }

    public function affectationQuota(Request $request){
        $cin = request()->query('cin');
        $user = User::where('cin', $cin)->first();
        $nombreDeProjets = Projet::where('ManagerCIN', $cin)->where('statut','En cours')->count();
        $nombreDeProjets1 = Projet::where('ManagerCIN', $cin)->where('statut','Terminé')->count();
        $formateur = Formateur::where('CIN', $cin)->first();
        $quota=$formateur->nb_max_des_appels;
        return view('backOffice.admin.quota')->with(['cin'=>$cin,'user'=>$user,'total'=>$nombreDeProjets,'total1'=>$nombreDeProjets1,'quota'=>$quota]);
    }

    public function quotaChange(Request $request){
        $cin = request()->query('cin');
        $user = Formateur::where('cin', $cin)->first();
//        dd($user);
        $nb = $request->input("appels");
//        dd($nb);
        $user->update(['nb_max_des_appels' => $nb]);
        $managers=User::where('role',"Manager")->get();
        return view('backOffice.admin.displayManagers')->with(['managers'=>$managers]);
    }

    public  function affectationDesManagers(Request $request){
        $cin = request()->query('cin');
        $analyst=User::where('CIN', $cin)->first();
        $managers = DB::table('users')
            ->where('role', '=', 'Manager')
            ->get();
        return view('backOffice.admin.ManagersAnalysts')->with(["managers"=>$managers,"cin"=>$cin,"analyst"=>$analyst]);
    }

    public function managersSubmit(Request $request){
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
            $project = Projet::where('ID', $project_id)->first();
        }
        }
}
