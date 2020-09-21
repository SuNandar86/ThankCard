<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>ThankCard Receive Score Detail By Employee</title> 
 <style type="text/css">
    .pdf_data{
       width: 100%;
       border:0;
    }
    .pdf_data td{
      text-align:  left;
    }
    .pdf_data th{
       text-align:  left;
    }
    .center{
      text-align: center;
    }
 </style>
</head>
<body>
  <h3 style="text-align: center;">Total Receive Card Detail By Employee</h3>
  <div>
      <table class="pdf_data">
	       <thead>
            <tr>
                <th>No</th>
                <th>From</th>
                <th>Department</th>
                <th>To</th> 
                <th>Date</th>                
                <th>Point</th> 
            </tr>
          </thead>
          <tbody>
            @for($i=0;$i<count($thankcards);$i++)
              <tr>
                  <td>{{$i+1}}</td>  
                  <td>{{ $thankcards[$i]['From_Emp']}}</td>
                  <td>{{ $thankcards[$i]['From_Dep_Name']}}</td> 
                  <td>{{ $thankcards[$i]['To_Emp']}} </td> 
                  <td>{{date('d-m-Y',strtotime($thankcards[$i]['Send_Date']))}}</td>
                  <td class="center">{{ $thankcards[$i]['CountResult']}}</td>  
              </tr>
            @endfor
          </tbody>
        </table>
  </div>
</body>
 
</html>