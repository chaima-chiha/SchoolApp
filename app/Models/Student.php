<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'date_de_naissance',
        'adress',
        'email',
        'classe',
    ];

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe' );
    }
}
