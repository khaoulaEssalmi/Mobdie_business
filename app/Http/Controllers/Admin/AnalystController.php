<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadController;
use App\Models\Contact;
use App\Models\User;
use Charts;
use Carbon\Carbon;
use App\Models\Score;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Message;
use Illuminate\Support\Facades\DB;


class AnalystController extends Controller{

    public function index()
    {
//        dd("hi");
        $cin = request()->query('cin');
        $count=request()->query('count');
        $nbrClients = 2000;
        $nbrProducts = 9800;
        $user = User::where('CIN', $cin)->first();
        return view('backOffice.analyst.dashboardAnalyst')->with(["count"=>$count,"nbrClients" => $nbrClients, "nbrProducts" => $nbrProducts, "user" => $user]);
    }

    public function displayManagers(){
        $cin=auth()->user()->cin;
        $count=request()->query('count');

//        dd($cin);
        $managers= DB::table('users')
            ->whereIn('CIN', function ($query) use ($cin) {
                $query->select('ManagerCIN')
                    ->from('analyst_managers')
                    ->where('AnalystCIN', $cin);
            })
            ->get();

//        dd($managers);
        return view('backOffice.analyst.displayManagers')->with(["count"=>$count,"managers"=>$managers]);

    }

    public function displayManagerProjects(Request $request){
        $cin=request()->input('cin');
        $count=request()->query('count');

        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

//        dd($endDate);
//        dd($startDate);
//        dd($cin);

//        $projets = DB::table('projets')
//            ->where('ManagerCIN', 'ZT67201')
//            ->get();

        $results = DB::table('projets')
            ->join('appels', 'projets.ID', '=', 'appels.ProjetID')
            ->leftJoin('candidats', 'candidats.ID', '=', 'projets.ID')
            ->select('projets.NomPr', DB::raw('MAX(projets.Statut) as Statut'), 'projets.ID', DB::raw('COUNT(appels.ProjetID) as appels_count'), DB::raw('(SELECT GROUP_CONCAT(CONCAT(c.Nom, " ", c.Prenom)) FROM candidats c WHERE c.ID = projets.ID) as candidats_names'), DB::raw('(SELECT IF(projets.Statut = "Completed", MAX(appels.Date_appel) - MIN(appels.Date_appel), NULL) FROM appels WHERE appels.ProjetID = projets.ID) as periode'))
            ->where('projets.ManagerCIN', $cin)
            ->groupBy('projets.NomPr', 'projets.ID', 'projets.Statut')
            ->get();



        $user = User::where('CIN', $cin)->first();

//        dd($results);

        $scores = Score::where('ManagerCIN',$cin)
            ->whereDate('Date', '>=', $startDate)
            ->whereDate('Date', '<=', $endDate)
            ->pluck('Score');

//        dd($scores);

        $labels=Score::where('ManagerCIN',$cin)
            ->whereDate('Date', '>=', $startDate)
            ->whereDate('Date', '<=', $endDate)
            ->pluck('Date');



        $monthlyScores = DB::table('scores')
            ->select(DB::raw('MONTH(Date) as mont'), DB::raw('MONTHNAME(Date) as month'), DB::raw('SUM(Score) / COUNT(id) as averageScore'))
            ->where('ManagerCIN', $cin)
            ->groupBy(DB::raw('MONTHNAME(Date)'), DB::raw('MONTH(Date)'))
            ->orderBy(DB::raw('MONTH(Date)'), 'ASC')
            ->get();



//        dd($labels);
//        dd($scores);
//        print_r(json_encode($scores));

//        $chart = Charts::create('line', 'highcharts')
//            ->title('Score Chart')
//            ->labels($scores->keys())
//            ->values($scores->values())
//            ->responsive(true);
//        dd($chart);


        return view('backOffice.analyst.displayManagerProjects')->with(["count"=>$count,"infos"=>$results,"user"=>$user,"scores"=>$scores,"labels"=>$labels,"monthlyScores" => $monthlyScores]);
    }

    public function emailManager(Request $request){
        $cin=request()->input('cin');
//        dd($cin);

        $cin2=auth()->user()->CIN;

    }

//    public function displayManagerProjectCalls(Request $request){
//
//        $ID=request()->input('prId');
////        dd($ID);
//
//        $appels = DB::table('appels')
//            ->where('ProjetID', $ID)
//            ->get();
//        $projet= DB::table('projets')
//            ->where('ID', $ID)
//            ->first();
//
//        return view("backOffice.analyst.displayManagerProjectCalls")->with(["projet"=>$projet,"appels"=>$appels]);
//    }

}
