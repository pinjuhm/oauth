

@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"> <h5 class="card-title">Name : {{ $students->first_name }}</h5></div>
                    <div class="card-body">
                      <form method="POST" action="{{ route('contact-view', ['roll_num' => $students->roll_num]) }}">
        
                        <br/>
                        <div class="table-responsive">
                          
                        
                            <table class="table">

                                <thead>
                                    <tr>
            
                                   
                                        <th scope="col">Ocjene</th>
                                      </tr>
                                      <td>{{ $students->marks }}</td>
                                </thead>
                                <tbody>

                              
                                </tbody>
                            </table>
                       
                        </div>
                      </form>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop

