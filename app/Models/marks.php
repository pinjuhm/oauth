<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\students;
use App\Models\subjects;

class marks extends Model
{
    use HasFactory;

    protected $table='marks';
    public $timestamps=false;
    protected $primaryKey = 'id';
    protected $fillable = ['student_roll_num','subject_id',
        'marks'
    ];

    public function students(){
        return $this->belongsTo(students::class);
    }
        public function subjects(){
        return $this->belongsTo(subjects::class);
    }
    
   


}
