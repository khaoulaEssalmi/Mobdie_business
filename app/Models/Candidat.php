<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidat extends Model
{
    use HasFactory;

    protected $table = 'candidats';

    protected $primaryKey = 'CandidatID';

    protected $fillable = [
        'ID',
        'Age',
        'Cin',
        'Commune',
        'Email',
        'Nom',
        'ID',
        'Prenom',
        'Province',
        'Telephone',
        'Institut_de_financement',
        'Statut_juridique',
        'Milieu',
    ];

    public  function  projets():HasMany {
        return $this->hasMany(Projet::class,'ID','ID');
    }
}
