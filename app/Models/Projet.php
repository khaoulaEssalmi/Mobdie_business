<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    use HasFactory;

    protected $table = 'projets';

    protected $primaryKey = 'ProjetID';

    protected $fillable = [
        'ProjetID',
        'CandidatID',
        'Nom',
        'Description',
        'Statut',
        'ManagerCIN',
        'AdminCIN',
    ];

    public function candidat():BelongsTo{
        return $this->belongsTo(Candidat::class,'ID','ID');
    }

    public function formateur():BelongsTo{
        return  $this->belongsTo(Manager::class,'FormateurCIN','CIN');
    }

    public function appels():HasMany{
        return $this->hasMany(Appel::class,'ProjetID','ID');
    }
}
