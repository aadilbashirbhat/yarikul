<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'std_name',
        'std_reg_no',
        'school_details',
    ];
    public function subjects()
    {
        return $this->hasMany(SubjectMark::class);
    }
}
