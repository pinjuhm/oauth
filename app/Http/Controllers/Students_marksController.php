<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use App\Models\departments;
use App\Models\marks;
use App\Models\subjects;
use Illuminate\Support\Facades\DB;

class Students_marksController extends Controller
{
    //
    public function index()
        {

        $marks=marks::with('students')->get();
        $students=students::with('marks')->get();
      
       
            return view('index', compact('students','marks'));
        }

        public function create()
        {
            return view('create');
        }

         /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

     public function store(Request $request)
     {
     $validatedData = $request->validate([
     
     'first_name' => 'required|max:25',
     'last_name' => 'required|max:25',
     'department_id' => 'required|in:1,3',
     'phone' => 'required|max:25',
     'admission_date' => 'required',
     'cet_marks' => 'required|max:11',
         
     ]);
     $show = Students::create($validatedData);

     return redirect('/')->with('success', 'Product is successfully saved');

 }

       

    public function destroy($roll_num)
    {
        // Find the student by roll number
        $student = Students::where('roll_num', $roll_num)->delete();
        return redirect('/')->with('status', 'Student deleted successfully');
        
    }

        public function edit($roll_num)
        {
            $students = students::find($roll_num);
          
            return view('edit', compact('students'));
         }

         public function update(Request $request,$roll_num){

            $students= students::find($roll_num);
            $students->first_name = $request->input('first_name');
            $students->last_name = $request->input('last_name');
            $students->department_id = $request->input('department_id');
            $students->phone = $request->input('phone');
            $students->admission_date = $request->input('admission_date');
            $students->cet_marks = $request->input('cet_marks');
            $students->update();
            return redirect('/')->with('status','Data update successfully');

         }

         public function show($roll_num)
         {
             $students = students::find($roll_num);
             return view('show')->with('students', $students);
         }

         public function update_marks(Request $request,$roll_num){

            
    
         }

         public function search(Request $request)
        {
            $output = "";
            $students = Students::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->get();

            foreach ($students as $students) {
                $output .= '<tr>
                    <td>' . $students->roll_num . '</td>
                    <td>' . $students->first_name . '</td>
                    <td>' . $students->last_name . '</td>
                    <td>' . $students->department_id . '</td>
                    <td>' . $students->phone . '</td>
                    <td rowspan="1">'.'</td>
                    <td>' . $students->admission_date . '</td>
                    <td rowspan="1">'.'</td>
                    <td>' . $students->cet_marks . '</td>
                    <td>
                        <a href="' . url('contact-view/' . $students->roll_num . $students->marks) . '" title="View Student" class="btn btn-info btn-sm">
                            <i class="fa fa-eye" aria-hidden="true"></i> View
                        </a>
                        <a href="' . url('update-edit/' . $students->roll_num) . '" title="Edit Student" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                        </a>
                        <form method="POST" action="' . url('/' . $students->roll_num) . '" accept-charset="UTF-8" style="display:inline">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(\'Confirm delete?\')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                        </button>
                </form>
                </td>


                    
                    </tr>';
            }

            return response($output);
        }

    

         

 

}
