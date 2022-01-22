<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportingteacher extends Model
{
    use HasFactory;
    protected $table = 'reporting_teacher';
    protected $primaryKey = 'teacher_id';
    protected $fillable = [
        'teacher_name'
    ];
}
