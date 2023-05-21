<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\marks;
use App\Models\departments;

class students extends Model
{
    use HasFactory;

    use HasFactory;
    public $table = 'students';
    public $timestamps=false;
    protected $primaryKey = 'roll_num';

    public $fillable = [ 'first_name', 'last_name','department_id','phone','admission_date','cet_marks'];
    
    public function marks(){
        return $this->hasMany(marks::class,'student_roll_num','roll_num');
    }
    public function departments(){
        return $this->belongsTo(departments::class);
    }


}
