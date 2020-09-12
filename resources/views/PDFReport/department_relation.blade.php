<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>ThankCard Score By Department Relation</title> 
 <style type="text/css">
    .pdf_data{
       width: 100%;
       border:0;
    }
    .pdf_data td{
      text-align:  center;
    }
 </style>
</head>
<body>
  <h3 style="text-align: center;">ThankCard Score By Department Relation</h3>
  <div>
      <table class="pdf_data">
	       <thead>
            <tr>
                <th>No</th>
                <th>From Department</th>
                <th>To Department </th> 
                <th>From</th> 
                <th>To</th> 
                <th>Total Score</th> 
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($thankcards);$i++)
                <tr>
                    <td>{{$i+1}}</td>  
                    <td>{{ $thankcards[$i]['F_Dept_Name']}}</td>
                    <td>{{ $thankcards[$i]['T_Dept_Name']}}</td> 
                    <td>{{ $thankcards[$i]['f_date']}}</td>
                    <td>{{ $thankcards[$i]['t_date']}}</td>
                    <td>{{ $thankcards[$i]['CountResult']}}</td> 
                </tr> 
            @endfor
        </tbody>
        </table>
  </div>
</body>
</html>