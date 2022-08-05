<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkModel extends Model
{
    protected $table ='student_marks';
    protected $fillable =['student_id','term','maths_mark','science_mark','history_mark','total_mark'];
}
