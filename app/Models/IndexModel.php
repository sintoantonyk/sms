<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexModel extends Model
{
    protected $table ='students';
    protected $fillable =['name','age','gender','teacher'];
}
