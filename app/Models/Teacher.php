<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'date_de_naissance',
        'adress',
        'email',
        'ville',
        'avec_CDI',
        'matiere',
    ];


        protected $casts = [
            'avec_CDI' => 'boolean',
            'matiere' => 'array',
        ];


}
