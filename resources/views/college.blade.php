<!DOCTYPE html>
<html>
  <head>
    <title> College</title>
  </head>
  <body>
    <header>
      <h1>Podatci o fakultetu</h1>
    </header>
    <main>
         
      <div class="table table-bordered table-striped">


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
        <tbody>
          @foreach($students as $row)
          @if($row['first_name'] == 'Rashmi')
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
                    
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                  </tr>
                  @else
                    

                  @endif

                
              @endforeach
        </tbody>
      </table>

      </div>

    </main>
    <footer>
      <p>&copy; 2023 My Simple HTML5 Project. All rights reserved.</p>
    </footer>
  </body>
  
   
    
</html>
