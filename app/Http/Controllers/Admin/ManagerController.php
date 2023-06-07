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
                    ->orWhereDate('appels.Prochain_appel', '<', $today);
            })
            ->where('appels.Done', '=', 0)
            ->select('candidats.*', 'projets.*','appels.AppelID')
            ->get();

//        dd($candidats);
//
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

        $AppelID=request()->input('AppelID');
        dd($AppelID);
        $agreed = request()->input("agreed");
        $discussed = request()->input("discussed");
        $appreciation = request()->input("appreciation");
        $call2 = request()->input("call2");
//        dd($call2);

        $id = request()->input("PrId");

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
                DB::table('appels')
                ->where('ProjetID','=',$id)
                ->whereDate('Prochain_appel', Carbon::today())
                ->update(['Done' => 1]);

            }
        }

//
//            else {
//                $currentDate = Carbon::today()->toDateString();
//            dd($currentDate);

//                $cin = auth()->user()->CIN;
//            dd($cin);

//                $manager = Manager::where('CIN', $cin)->first();
//                $nb = $manager->nb_max_des_appels;
//            dd($nb)
//            }
//
//            $scores = Score::where('ManagerCIN', $cin)
//                ->whereDate('Date', $currentDate)
//                ->first();


//            dd($inc);

////            if (empty($scores)){
////                $score=new Score();
////                $score->Date=$currentDate;
////                $score->Score=$inc;
////                $score->ManagerCIn=$cin;
////
////                $score->save();
////            }
////            else{
////                $scores->Score=$scores->Score+$inc;
////                $scores->save();
////            }
//
//            DB::table('appels')
//                ->where('ProjetID','=',$id)
//                ->whereDate('Prochain_appel', Carbon::today())
//                ->update(['Done' => 1]);
//
//            $appel = Appel::where('ProjetID', $id)->first();
//            if ($appel->Commentaire === null && $appel->date_appel === null && $appel->prochain_appel === null) {
//                Appel::where('ProjetID', $id)
//                    ->whereNull('Date_appel')
//                    ->whereNull('Prochain_appel')
//                    ->whereNull('Commentaire')
//                    ->delete();
//
////                $appel = new Appel();
////                $appel->Commentaire = $comment;
////                $appel->Date_appel = $call1;
////                $appel->Prochain_appel = $call2;
////                $appel->Done = 0;
////                $appel->ProjetID = $id;
////
////                $appel->save();
//
//                $cin = auth()->user()->CIN;
//                $candidats = DB::table('candidats')
//                    ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
//                    ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
//                    ->where('projets.ManagerCIN', $cin)
//                    ->where(function ($query) {
//                        $query->whereNull('appels.Prochain_appel')
//                            ->orWhereDate('appels.Prochain_appel', Carbon::today());
//                    })
//                    ->where('appels.Done', '=', 0)
//                    ->select('candidats.*', 'projets.*')
//                    ->get();
//                return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);
//
//            }
//            else {
////                $appel = new Appel();
////                $appel->Commentaire = $comment;
////                $appel->Date_appel = $call1;
////                $appel->Prochain_appel = $call2;
////                $appel->Done = 0;
////                $appel->ProjetID = $id;
//
//                $appel->save();
//                $cin = auth()->user()->CIN;
//                $candidats = DB::table('candidats')
//                    ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
//                    ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
//                    ->where('projets.ManagerCIN', $cin)
//                    ->where(function ($query) {
//                        $query->whereNull('appels.Prochain_appel')
//                            ->orWhereDate('appels.Prochain_appel', Carbon::yesterday());
//                    })
//                    ->where('appels.Done', '=', 0)
//                    ->select('candidats.*', 'projets.*')
//                    ->get();
//                return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);
//            }
//        }
//        elseif ($buttonClicked === 'mark'){
//            $id=request()->input('PrId');
////            dd($id);
//            $call1=request()->input("call1");
//            $comment=request()->input("comment");
//
//            $appel = new Appel();
//            $appel->Commentaire = $comment;
//            $appel->Date_appel = $call1;
//            $appel->ProjetID=$id;
//            $appel->Done=1;
//            $appel->save();
//
//            DB::table('appels')
//                ->where('ProjetID','=',$id)
//                ->whereDate('Prochain_appel','<=', Carbon::today())
//                ->update(['Done' => 1]);
//
//            Projet::where('ID', $id)
//                ->update(['Statut' => 'Completed']);
//
//        }
//        $cin=auth()->user()->CIN;
//        $today=Carbon::today();
//        $candidats = DB::table('candidats')
//            ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
//            ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
//            ->where('projets.ManagerCIN', $cin)
//            ->where(function ($query) use ($today) {
//                $query->whereNull('appels.Prochain_appel')
//                    ->orWhereDate('appels.Prochain_appel', '<',$today);
//            })
//            ->where('appels.Done','=', 0)
//            ->select('candidats.*', 'projets.*')
//            ->get();
//
//        return view('backOffice.manager.displayCalls')->with(['candidats'=>$candidats]);
        }
}
