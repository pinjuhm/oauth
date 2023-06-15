<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use App\Models\departments;
use App\Models\marks;
use App\Models\subjects;
use App\Models\User;
use App\Models\admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Students_marksController extends Controller
{
    //
    public function index()
        {
            $marks = marks::with('students')->get();
            $students = students::with('marks')->get();
            $subjects = subjects::all();
            $predmeti = subjects::all();

            $role = session('role'); 
            

            
            
        
            return view('index', compact('students', 'marks', 'subjects','role'));
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
                $student = students::find($roll_num);
                $subjects = subjects::all();
                $marks = marks::where('student_roll_num', $roll_num)->get();
                

                return view('show', compact('student', 'subjects', 'marks'));
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

        public function addMarks(Request $request, $roll_num)
{
    $validatedData = $request->validate([
        'subject' => 'required',
        'marks' => 'required|numeric|min:1|max:5',
    ]);

    $subjectId = $request->input('subject');
    $marksValue = $request->input('marks');

    // Create a new marks instance
    $newMarks = new marks();
    $newMarks->student_roll_num = $roll_num;
    $newMarks->subject_id = $subjectId; // Assign subject_id directly
    $newMarks->marks = $marksValue; // Assign marks directly
    $newMarks->save();

    return redirect()->route('contact-view', ['roll_num' => $roll_num])->with('success', 'Marks added successfully!');
        }

        public function loginprikaz()
        {
            return view('login');
        } 

        public function registration()
        {
            return view('singup');
        } 

        public function customRegistration(Request $request)
            {  
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                ]);
                    
                $data = $request->all();
                $check = $this->createregistration($data);
                
                return view('login');
            }
        
        
            public function createregistration(array $data)
            {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            }


            
            public function showLoginForm()
            {
                return view('login');
            }

            public function login(Request $request)
            {
                $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                if (Auth::attempt($credentials)) {
                    
                    session()->put('role', 'user');
                    return redirect()->route('index');
                } else {
                    
                    return back()->withErrors(['email' => 'Invalid email or password']);
                }
            }
            
   
            public function signOut() {
                Session::flush();
                Auth::logout();
           
                return Redirect('login');
            }

            public function logout()
            {
                Auth::logout();
                return redirect()->route('login');


            }
            
            public function showLoginFormadmin()
            {
                return view('loginadmin');
            }

            public function loginadmin(Request $request)
                {
                    $credentials = $request->validate([
                        'email' => 'required|email',
                        'password' => 'required',
                    ]);

                    $admin = Admin::where('email', $credentials['email'])->first();

                    if ($admin && $credentials['password'] === $admin->password) {
                        session()->put('role', 'admin');
                        
                        return redirect()->route('index');
                    } else {
                        
                        return back()->withErrors(['email' => 'Invalid email or password']);
                    }
                }




           

            
    



 

}
