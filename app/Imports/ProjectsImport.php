<?php

namespace App\Imports;

use App\Models\Projet;
use Maatwebsite\Excel\Concerns\ToModel;

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
        return new Projet([
            'ID' => $row[0],
            'NomPr' => $row[1],
            'Statut' => "En attente",
            'ManagerCIN' => $row[2],
            'AdminCIN' => $row[3],
            'CandidatID' => $row[4],
        ]);
    }
}
