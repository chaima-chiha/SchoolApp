<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClasse extends Model
{
    use HasFactory;
    protected $fillable = [
        'Annee_Scolaire',
        'teacher_id',
        'classe_id',
    ];
    

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id' );
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id' );
    }
   
}
