@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Name: {{ $student->first_name }}</h5>
                    </div>
                    <div class="card-body">
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>
                                        <form method="POST" action="{{ route('add-marks', ['roll_num' => $student->roll_num]) }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="subject">Odaberi predmet:</label>
                                                <select name="subject" id="subject" class="form-control">
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="marks">Upisi ocjenu:</label>
                                                <input type="text" name="marks" id="marks" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Potvrdi</button>
                                        </form>

                                        <select name="subjects" id="subjects" class="form-control">
                                            <option value="subjects" >Odabir predmeta</option>
                                            @foreach ($subjects as $subject )
                                                <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                                                
                                            @endforeach
                                        </select>   


                                    </th>
                                </thead>
                                <thead>
                                    <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            <td>
                                                @foreach($marks as $mark)
                                                    @if($mark->subject_id == $subject->id)
                                                        {{ $mark->marks }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
