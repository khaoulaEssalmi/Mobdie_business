<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\Appel;
use App\Models\User;
use App\Models\Projet;
use App\Models\Manager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ManagerController extends Controller
{
    public function index()
    {
        $cin = request()->query('cin');
        $nbrClients = 2000;
        $nbrProducts = 9800;
        $user = User::where('CIN', $cin)->first();
        return view('backOffice.manager.dashboardManager')->with(["nbrClients" => $nbrClients, "nbrProducts" => $nbrProducts, "user" => $user]);
    }

    public function calls(Request $request){
        $cin=request()->input('cin');
        $today=Carbon::today();
        $candidats = DB::table('candidats')
            ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
            ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
            ->where('projets.ManagerCIN', $cin)
            ->where(function ($query) use ($today) {
                $query->whereNull('appels.Prochain_appel')
                    ->orWhereDate('appels.Prochain_appel', '<',$today);
            })
            ->where('appels.Done','=', 0)
            ->select('candidats.*', 'projets.*')
            ->get();

        return view('backOffice.manager.displayCalls')->with(['candidats'=>$candidats]);
    }
    public function callCandidat(Request $request){
        $ProjetID=request()->input('ProjetID');
        $appels = DB::table('appels')
            ->where('ProjetID', '=', $ProjetID)
            ->orderBy('date_appel', 'asc')
            ->get();


        $Pr = DB::table('projets')
            ->where('ID', '=',$ProjetID)
            ->first();

        return view('backOffice.manager.displayProjectCalls')->with(['appels'=>$appels,'Pr'=>$Pr]);
    }

    public function CallCandidatSubmit(Request $request)
    {
        $call1=request()->input("call1");
//        dd($call1);
        $call2=request()->input("call2");
        $comment=request()->input("comment");
        $id=request()->input("PrId");

        $buttonClicked = $request->input('button_clicked');

        if ($buttonClicked === 'validate') {

            DB::table('appels')
                ->where('ProjetID','=',$id)
                ->whereDate('Prochain_appel', Carbon::today())
                ->update(['Done' => 1]);

            $appel = Appel::where('ProjetID', $id)->first();
            if ($appel->Commentaire === null && $appel->date_appel === null && $appel->prochain_appel === null) {
                Appel::where('ProjetID', $id)
                    ->whereNull('Date_appel')
                    ->whereNull('Prochain_appel')
                    ->whereNull('Commentaire')
                    ->delete();

                $appel = new Appel();
                $appel->Commentaire = $comment;
                $appel->Date_appel = $call1;
                $appel->Prochain_appel = $call2;
                $appel->Done = 0;
                $appel->ProjetID = $id;

                $appel->save();

                $cin = auth()->user()->CIN;
                $candidats = DB::table('candidats')
                    ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
                    ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
                    ->where('projets.ManagerCIN', $cin)
                    ->where(function ($query) {
                        $query->whereNull('appels.Prochain_appel')
                            ->orWhereDate('appels.Prochain_appel', Carbon::yesterday());
                    })
                    ->where('appels.Done', '=', 0)
                    ->select('candidats.*', 'projets.*')
                    ->get();
                return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);

            }
            else {
                $appel = new Appel();
                $appel->Commentaire = $comment;
                $appel->Date_appel = $call1;
                $appel->Prochain_appel = $call2;
                $appel->Done = 0;
                $appel->ProjetID = $id;

                $appel->save();
                $cin = auth()->user()->CIN;
                $candidats = DB::table('candidats')
                    ->join('projets', 'candidats.ID', '=', 'projets.CandidatID')
                    ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
                    ->where('projets.ManagerCIN', $cin)
                    ->where(function ($query) {
                        $query->whereNull('appels.Prochain_appel')
                            ->orWhereDate('appels.Prochain_appel', Carbon::yesterday());
                    })
                    ->where('appels.Done', '=', 0)
                    ->select('candidats.*', 'projets.*')
                    ->get();
                return view('backOffice.manager.displayCalls')->with(['candidats' => $candidats]);
            }
        }
        elseif ($buttonClicked === 'mark'){
            $id=request()->input('PrId');
//            dd($id);
            $call1=request()->input("call1");
            $comment=request()->input("comment");

            $appel = new Appel();
            $appel->Commentaire = $comment;
            $appel->Date_appel = $call1;
            $appel->ProjetID=$id;
            $appel->save();

            DB::table('appels')
                ->where('ProjetID','=',$id)
                ->whereDate('Prochain_appel', Carbon::today())
                ->update(['Done' => 1]);

            Projet::where('ID', $id)
                ->update(['Statut' => 'Completed']);

        }
    }
}
