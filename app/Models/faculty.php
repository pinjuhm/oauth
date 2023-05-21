<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\departments;
use App\Models\subjects;

class faculty extends Model
{
    use HasFactory;

    public $table = 'faculty';
    public $timestamps=false;
    protected $primaryKey = 'id';

    public $fillable = [ 'first_name', 'last_name','department_id','phone'];

    public function departments(){
        return $this->belongsTo(departments::class);
    }

    public function departmentasmany(){
        return $this->hasMany(departments::class,'hod_id','id');
    }

    public function subjects(){
        return $this->hasMany(subjects::class,'faculty_id','id');
    }




}
    
