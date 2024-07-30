<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'type',
        'matiere',
    ];
    protected $casts = [
        'matiere' => 'array',
    ];
 


}
