<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\faculty;
use App\Models\students;
use App\Models\subjects;

class departments extends Model
{
    use HasFactory;

    protected $table = 'departments';
    public $timestamps=false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','hold_id'


    ];

    public function students(){
        return $this->hasMany(students::class,'department_id','id');
    }
    
    public function faculty(){
        return $this->hasMany(faculty::class,'department_id','id');
    }

    public function subjects(){
        return $this->hasMany(subjects::class, 'department_id','id');

    }
    public function facultyone(){
        return $this->belongsTo(faculty::class);
    }
    
    


}
