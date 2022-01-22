<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marklist extends Model
{
    use HasFactory;
    protected $table = 'mark_list';
    protected $primaryKey = 'marklist_id';
    protected $fillable = [
        'student_id', 'term', 'maths', 'science','history'
    ];
    use SoftDeletes;

    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }
}
