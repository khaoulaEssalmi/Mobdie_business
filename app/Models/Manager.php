<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Manager extends User
{
    use HasFactory;
    protected $primaryKey = 'CIN';
    protected $fillable = [
        'CIN',
        'nb_max_des_appels',
    ];

    public function projets():HasMany{
        return $this->hasMany(Projet::class,'FormateurCIN','CIN');
    }
}
