<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appel extends Model
{
    use HasFactory;

    protected $primaryKey = 'AppelID';

    protected $fillable = [
        'AppelID',
        'Commentaire',
        'Date_appel',
        'Prochain_appel',
        'ProjetID',
    ];

    public function projet():BelongsTo{
        return $this->belongsTo(Projet::class,'ProjetID','ID');
    }
}
