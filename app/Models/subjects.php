<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\marks;
use App\Models\faculty;

class subjects extends Model
{
    use HasFactory;

    
    protected $table='subjects';
    public $timestamps=false;
    protected $primaryKey = 'id';
    protected $fillable = ['department_id',
        'start_date','end_date','name','faculty_id'
    ];

    public function marks(){
        return $this->hasMany(marks::class,'subject_id','id');
    }

    public function faculty(){
        return $this->belongsTo(faculty::class);

    }
}
