<?php

namespace App\Imports;

use App\Models\Candidat;
use App\Models\Projet;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class ProjectsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
        $result = DB::table('candidats')
            ->select('ID')
            ->where('Cin', '=', $row[2])
            ->first();
//        dd($result);

        if ($result === null) {
            $Candidat= new Candidat([
                'ID'=> $row[0],
                'Age'=>$row[1],
                'Cin'=>$row[2],
                'Commune'=>$row[3],
                'Email'=>$row[4],
                'Nom'=>$row[5],
                'Prenom'=>$row[6],
                'Province'=>$row[7],
                'Telephone'=>$row[8],
                'Institut_de_financement'=>$row[9],
                'Statut_juridique'=>$row[10],
                'Milieu'=>$row[11],
            ]);
            $Candidat->save();

            $Projet= new Projet([
                'Nom' => $row[12],
                'Description'=>$row[13],
                'Statut' => "Pending",
                'CandidatID' => $row[0],
            ]);
            $Projet->save();
        }
        else{
//            dd($result->CandidatID);

            $Projet= new Projet([
                'Nom' => $row[12],
                'Description'=>$row[13],
                'Statut' => "Pending",
                'CandidatID' => $result->ID,
            ]);
            $Projet->save();

            $cin=$row[2];
//            dd($cin);
            $candidat = Candidat::where('cin', '=', $cin)->first();
//            dd($candidat->Age);
            $candidat->Age=$row[1];
            $candidat->Commune=$row[3];
            $candidat->Email=$row[4];
            $candidat->Province=$row[7];
            $candidat->Telephone=$row[8];
            $candidat->Institut_de_financement=$row[9];
            $candidat->Statut_juridique=$row[10];
            $candidat->Milieu=$row[11];
            $candidat->save();


        }
    }
}
