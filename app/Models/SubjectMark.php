<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'subject_name',
        'max_marks',
        'marks',
        'percentage',
        'status',
    ];
}
