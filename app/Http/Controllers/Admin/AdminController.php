<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Imports\importClass;
use Illuminate\Support\Facades\Validator;
use App\Imports\ProjectsImport;
use App\Models\AnalystManager;
use App\Models\Message;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Projet;
use Carbon\Carbon;
use App\Models\Manager;
use App\Models\Appel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



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
        $count=request()->query('count');
        $analysts = DB::table('users')
            ->where('role', 'Analyst')
            ->where('etat',1)
            ->get();

        return view("backOffice.admin.displayAnalysts", ['analysts'=>$analysts,'count'=>$count]);
    }

    public function affectationDesProjets()
    {
        $cin = request()->query('cin');

        $user = User::where('CIN', $cin)->first();

        $projects = DB::table('projets')
            ->where('Statut', '=', 'Pending')
            ->orWhere('Statut', '=', 'Blocked')
            ->get();
//        dd($projects);
        $totalProjects = Projet::where('managerCIN', $cin)->where('Statut', 'In progress')->count();
//        dd($totalProjects);
        return view('backOffice.admin.ProjectsManagers')->with(["projects" => $projects, "cin" => $cin, "user" => $user, "total" => $totalProjects]);
    }

    public function projectsSubmit(Request $request)
    {
        $cin = request()->query('cin');
        $manager=User::find($cin);
        $user = auth()->user();

        $managers = User::where('role', "Manager")->get();

        $user = auth()->user();
        $adminCIN = $user->CIN;


        $selected_projects = $request->input('action');
        $projects = Projet::whereIn('ProjetID', $selected_projects)->get();
        $selected_projects_array = $projects->toArray();
        $selected_projects_ids = array_column($selected_projects_array, 'ProjetID');
//        dd($selected_projects_ids);

        $count = count($selected_projects_ids);
//        dd($count);


        foreach ($selected_projects_ids as $project_id) {

//            $res= Projet::select('Nom')
//                ->where('ProjetID', $project_id)
//                ->first();
//
//            dd($res);

//            $nomProjet=$res->Nom;



            $result = Projet::select('Statut')
                ->where('ProjetID', $project_id)
                ->first();

//            dd($result);

            if($result->Statut==="Blocked")
            {
                Projet::where('ProjetID', $project_id)
                    ->update([
                        'Statut' => 'In progress',
                        'AdminCIN' => $adminCIN,
                        'ManagerCIN' => $cin
                    ]);
            }
            else if ($result->Statut==="Pending")
            {
                Projet::where('ProjetID', $project_id)
                    ->update([
                        'Statut' => 'In progress',
                        'AdminCIN' => $adminCIN,
                        'ManagerCIN' => $cin
                    ]);

                $appel=new Appel();
                $appel->ProjetID=$project_id;
                $appel->save();
            }
        }


        $managers = DB::table('users')
            ->where('role', 'Manager')
            ->where('etat',1)
            ->get();
        Session::flash('success', 'Well-affected projects');

        return view("backOffice.admin.displayManagers")->with(["managers"=>$managers]);
    }


    public function affectationDesManagers(Request $request)
    {

        $cin = request()->query('cin');
        $analyst = User::where('CIN', $cin)->first();

        $excludedManagerCINs = DB::table('analyst_managers')
            ->where('AnalystCIN', $cin)
            ->pluck('ManagerCIN');


        $managers = DB::table('users')
            ->whereNotIn('CIN', $excludedManagerCINs)
            ->where('role', 'Manager')
            ->where('etat',1)
            ->get();

        return view('backOffice.admin.ManagersAnalysts')->with(["managers" => $managers, "cin" => $cin, "analyst" => $analyst,]);
    }

    public function managersSubmit(Request $request)
    {
        $cin = request()->query('cin');
        $count=request()->query('count');

        $user = auth()->user();
        $selected_managers = $request->input('action');
        $managers = User::whereIn('CIN', $selected_managers)->get();
        $selected_managers_cin_array = $managers->pluck('CIN')->toArray();
//        dd($selected_managers_cin_array);
//        $message = "You have been assigned to the following managers :\n\n";

//        $selected_managers_ids = array_column($selected_managers_array, 'CIN');
//        dd($selected_managers_cin_array);
        foreach ($selected_managers_cin_array as $manager_id) {
            $user = User::where('CIN', $manager_id)->first();
            $name=$user->name;
//            $message .= "- " . $name . "\n";

            AnalystManager::create([
                'ManagerCIN' => $manager_id,
                'AnalystCIN' => $cin,
            ]);
        }


//        $envoi=new Message();
//        $envoi->Emetteur=auth()->user()->CIN;
//        $envoi->Recepteur=$cin;
//        $envoi->Message=$message;
//        $envoi->state=1;
//        $envoi->date_envoi= Carbon::now();

//        $envoi->save();

        $analysts = DB::table('users')
            ->where('role', 'Analyst')
            ->where('etat',1)
            ->get();

        Session::flash('success', 'Well-affected managers');

        return view("backOffice.admin.displayAnalysts", ["analysts"=>$analysts,"count"=>$count]);
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
        $cinMan= request()->query('cinMan');
//        dd($cinMan);
        $cinAna=request()->query('cinAna');
//        dd($cinAna);

        AnalystManager::where('ManagerCIN', $cinMan)
            ->where('AnalystCIN', $cinAna)
            ->delete();

        Session::flash('success', 'Analyst successfully deleted');

        $managers = DB::table('users')
            ->where('role', 'Manager')
            ->where('service',1)
            ->get();
//dd($managers);
        return view("backOffice.admin.displayManagers")->with(["managers"=>$managers]);

    }

    public function addManager()
    {
        return view("backOffice.admin.addManager");
    }

    public function addManagerSubmit(Request $request)
    {
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
            $user->role = "Manager";
            $user->etat=1;
            $user->picture = $request->file('images') ? UploadController::userPic($request) : "avatar.png";

            $user->save();

            $managers = User::where('role', 'Manager')
                ->where('etat', 1)
                ->get();
            Session::flash('success', 'user successfully adds');

            return view("backOffice.admin.displayManagers")->with(["managers"=>$managers]);
        } elseif ($request->input('button_clicked') == 'cancel') {
            $managers = User::where('role', 'Manager')
                ->where('etat', 1)
                ->get();
            return view("backOffice.admin.displayManagers")->with(["managers"=>$managers]);
        }
    }

    public  function  delete(request $request){
        $cin=request()->input('cin');
//        dd($cin);

        User::where('cin', $cin)->update(['etat' => 0]);
        Projet::where('ManagerCIN', $cin)
            ->where('Statut', 'In progress')
            ->update(['Statut' => 'Blocked']);

        AnalystManager::where('ManagerCIN', $cin)
            ->delete();


        Session::flash('success', 'Manager successfully deleted');

        $managers = DB::table('users')
            ->where('role', 'Manager')
            ->where('etat',1)
            ->get();
//dd($managers);
        return view("backOffice.admin.displayManagers")->with(["managers"=>$managers]);

    }

    public function import(){
        return view("backOffice.admin.import");
    }

    public function importcsv(Request $request){
        $file = $request->file('csvFile');
//        dd($file);
        Excel::import(new ProjectsImport, $file);
        Session::flash('success', 'Successfully importing data');
//        dd(session('success'));
        return redirect()->back();


    }
}
