
@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">List students</div>
                    <div class="card-body">
                        <a href="{{ route('logout') }}">Logout</a>

                        
                        <a href="{{ url('/create') }}" class="btn btn-success btn-sm" title="Add New Contact">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Students
                            

                        </a>
                        <br/>
                        <br/>
                        <div class="container">
                            <div class="search">
                                <input type="search" name="search" id="search" placeholder="Search Something Here" class="form-control">
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                        
                            <table class="table">

                                <thead>
                                    <tr>
            
                                        <th scope="col">Roll_num</th>
                                        <th scope="col">Ime</th>
                                        <th scope="col">Prezime</th>
                                        <th scope="col">Odjeljenje</th>
                                        
                                        <th scope="col">Phone</th>  
                                        <td rowspan="1"></td>
                                        <th scope="col">admission_data</th>
                                        <td rowspan="1">   </td>
                                        <th scope="col">cet_marks</th>
                                      </tr>
                                </thead>
                                <tbody class="allData">

                                @foreach($students as $row)
                                    <tr>
                                        <tr>
                                            <td>{{ $row->roll_num}}</td>
                                            <td>{{ $row->first_name}}</td>
                                            <td>{{ $row->last_name}}</td>
                                            <td>{{ $row->department_id}}</td>
                                            <td>{{ $row->phone}}</td>
                                            <td rowspan="1"></td>
                                            <td>{{ $row->admission_date}}</td>
                                            <td rowspan="1">   </td>
                                            <td>{{ $row->cet_marks}}</td>
                                            
 
                                        <td>
                                            
                                            <a href="{{ url('contact-view/' . $row->roll_num . $row->marks . $subjects) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            
                                            <a href="{{ url('update-edit/' . $row->roll_num) }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url( '/' . $row->roll_num) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            
 
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tbody id="Content" class="searchdata"></tbody>
                            </table>
                            @foreach ($subjects as $subject )
                            <p>{{ $subject->name }}</p>
                                
                            @endforeach
                       
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                var value = $(this).val();

                if (value) {
                    $('.allData').hide();
                    $('.searchdata').show();
                } else {
                    $('.allData').show();
                    $('.searchdata').hide();
                }
    
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search') }}',
                    data: { 'search': value },
                    success: function (data) {
                        console.log(data);
                        $('#Content').html(data);
                    }
                });
            });
        });
    </script>
    
@endsection



