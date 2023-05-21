<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departments;

class dep_fac_stu_subController extends Controller
{
    function index(){
        $data = departments::join('faculty', 'faculty.department_id', '=', 'departments.id')->get(['faculty.first_name']);
        

        return view('college', compact('data'));

    }
    
    
}
