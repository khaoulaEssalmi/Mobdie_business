<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\Appel;
use App\Models\User;
use App\Models\Projet;
use App\Models\Score;
use App\Models\Manager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class ManagerController extends Controller
{
    public function index()
    {
        $cin = request()->query('cin');
        $count = request()->query('count');

        $nbrClients = 2000;
        $nbrProducts = 9800;
        $user = User::where('CIN', $cin)->first();
        return view('backOffice.manager.dashboardManager')->with(["count" => $count, "nbrClients" => $nbrClients, "nbrProducts" => $nbrProducts, "user" => $user]);
    }

    public function calls(Request $request)
    {
        $cin = request()->input('cin');
        $today = Carbon::today();
//        dd($today);
        $candidats = DB::table('candidats')
            ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
            ->join('appels', 'projets.ProjetID', '=', 'appels.ProjetID')
            ->where('projets.ManagerCIN', $cin)
            ->where(function ($query) use ($today) {
                $query->whereNull('appels.Prochain_appel')
                    ->orWhereDate('appels.Prochain_appel', '<=', $today);
            })
            ->where('appels.Done', '=', 0)
            ->select('candidats.*', 'projets.*','appels.AppelID')
            ->get();

//        dd($candidats);

        Session::flash('success', 'Call made');

        return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);
    }

    public function callCandidat(Request $request)
    {
        $AppelID=request()->input('AppelID');
//        dd($AppelID);

        $ProjetID = request()->input('ProjetID');
//        dd($ProjetID);
        $Telephone = request()->input('Telephone');
//        dd($Telephone);
        $appels = DB::table('appels')
            ->where('ProjetID', '=', $ProjetID)
            ->orderBy('date_appel', 'asc')
            ->get();


        $Pr = DB::table('projets')
            ->where('ProjetID', '=', $ProjetID)
            ->first();
        return view('backOffice.manager.displayProjectCalls')->with(['appels' => $appels, 'Pr' => $Pr, 'Telephone' => $Telephone,'AppelID'=>$AppelID]);
    }

    public function CallCandidatSubmit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'call2' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
        ]);

        $PrId=request()->input("PrId");
//        dd($PrId);

        $AppelID=request()->input('AppelID');
//        dd($AppelID);

        $agreed = request()->input("agreed");
        $discussed = request()->input("discussed");
        $appreciation = request()->input("appreciation");

        $call2 = request()->input("call2");
//        dd($call2);

        $currentDate = Carbon::today()->toDateString();
//        dd($currentDate);

        $id = request()->input("PrId");

        $appel = DB::table('appels')
            ->where('AppelID', $AppelID)
            ->first();

//            dd($appel);

        $cin=auth()->user()->Cin;
//        dd($cin);

        if ($request->input('button_clicked') == 'validate') {
            $validator = Validator::make($request->all(), [
                'call2' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            ],
                [
                    'call2.after_or_equal' => 'The date must be greater than or equal to today.',
                ]);
            $errors = $validator->errors();
//            dd($errors);
            if ($errors->any()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else{
                $scores = Score::where('ManagerCIN', $cin)
                    ->whereDate('Date', $currentDate)
                    ->first();
//                    dd($scores);
                if (empty($scores)){
                    $score=new Score();
                    $score->Date=$currentDate;
                    $score->Score=1;
                    $score->ManagerCIn=$cin;

                    $score->save();
                }
                else{
                    $scores->Score=$scores->Score+1;
                    $scores->save();
                }

                if($appel->Appreciation===null && $appel->Elements_discutes===null && $appel->Elements_convenus===null && $appel->Date_appel===null && $appel->Prochain_appel===null){
//                    dd("hi");
                    DB::table('appels')
                        ->where('AppelID', $AppelID) // Utilisez la clé primaire (AppelID) pour sélectionner l'enregistrement à mettre à jour
                        ->update([
                            'Appreciation' => $appreciation,
                            'Elements_discutes' => $discussed,
                            'Elements_convenus' => $agreed,
                            'Date_appel' => $currentDate,
                            'Prochain_appel' => $call2,

                        ]);
                }
                else{

                    $appel1 = new Appel();
                    $appel1->Appreciation = $appreciation;
                    $appel1->Elements_discutes = $discussed;
                    $appel1->Elements_convenus = $agreed;
                    $appel1->Date_appel =$currentDate;
                    $appel1->Prochain_appel = $call2;
                    $appel1->ProjetID =$PrId;

                    $appel1->save();

                    DB::table('appels')
                        ->where('AppelID', $AppelID)
                        ->update(['Done' => 1]);

                }
            }
        }
        elseif ($request->input('button_clicked') == 'mark'){
            DB::table('projets')
                ->where('ProjetID', $PrId) // Remplacez $valeurId par la valeur réelle de l'ID du projet à mettre à jour
                ->update(['Statut' => 'Terminated']);

            $appel = new Appel();
            $appel->Appreciation = $appreciation;
            $appel->Elements_discutes = $discussed;
            $appel->Elements_convenus = $agreed;
            $appel->Date_appel =$currentDate;
            $appel->Prochain_appel = null;
            $appel->ProjetID =$PrId;

            $appel->save();

            DB::table('appels')
                ->where('AppelID', $AppelID)
                ->update(['Done' => 1]);
        }

        $today = Carbon::today();

        $candidats = DB::table('candidats')
            ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
            ->join('appels', 'projets.ProjetID', '=', 'appels.ProjetID')
            ->where('projets.ManagerCIN', $cin)
            ->where(function ($query) use ($today) {
                $query->whereNull('appels.Date_appel')
                    ->orWhereDate('appels.Prochain_appel', '<=', $today);
            })
            ->where('appels.Done', '=', 0)
            ->select('candidats.*', 'projets.*','appels.AppelID')
            ->get();
        return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);

    }
}
