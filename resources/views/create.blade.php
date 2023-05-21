<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
  
    Add Student
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ url('create') }}">
          
          <div class="form-group">
              @csrf
              <label for="country_name">First_name:</label>
              <input type="text" class="form-control" name="first_name"/>
              <br>
          
          </div>

          <div class="form-group">
              <label for="cases">Last_name :</label>
              <input type="text" class="form-control" name="last_name"/>
              <br>
          
          </div>

         
        <div class="form-group">
          <label class="radio-inline">
              <input type="radio" id="smt-fld-1-2" name="department_id" value="1">Computer
          </label>
          <br>
          <label class="radio-inline">
              <input type="radio" id="smt-fld-1-3" name="department_id" value="3">Information Technology
          </label>
          <br>
          <br>
          
          
      </div>
      


          <div class="form-group">
            @csrf
            <label for="country_name">Phone:</label>
            <input type="text" class="form-control" name="phone"/>
            <br>
          
        </div>

        <div class="form-group">
            @csrf
            <label for="country_name">Admision date:</label>
            <input type="date" class="form-control" name="admission_date"/>
            <br>
          
        </div>

        <div class="form-group">
            @csrf
            <label for="country_name">cet_marks:</label>
            <input type="number" class="form-control" name="cet_marks"/>
            <br>
          
        </div>

          <button type="submit" class="btn btn-primary">Add Students</button>

          
      </form>

      
  </div>
</div>
@endsection
