<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marks;
use App\Models\subjects;
use App\Models\students;


class sub_markController extends Controller
{
    //
    function index(){
        $marks=marks::with('subjects')->get();
        $subjects=subjects::with('marks')->get();
       



        return view('college', compact('subjects','marks'));
    }

    public function show($roll_num)
    {
        $students = students::find($roll_num);
        return view('show')->with('students', $students);
    }


}
