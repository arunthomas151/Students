<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'student_name','age','gender','teacher_id'
    ];
    use SoftDeletes;

    public function teacher()
    {
        return $this->belongsTo(Reportingteacher::class , 'teacher_id');
    }
}
