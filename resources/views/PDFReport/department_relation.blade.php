<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>ThankCard Score By Department Relation</title> 
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
  <h3 style="text-align: center;">Total Card Between Department</h3>
  <div>
      <table class="pdf_data">
	       <thead>
            <tr>
                <th>No</th>
                <th>From Department</th>
                <th>To Department </th> 
                <th>From</th> 
                <th>To</th> 
                <th>Point</th> 
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($thankcards);$i++)
                <tr>
                    <td>{{$i+1}}</td>  
                    <td>{{ $thankcards[$i]['F_Dept_Name']}}</td>
                    <td>{{ $thankcards[$i]['T_Dept_Name']}}</td> 
                    <td>{{date('d-m-Y',strtotime($thankcards[$i]['f_date']))}}</td>
                    <td>{{date('d-m-Y',strtotime($thankcards[$i]['t_date']))}}</td>
                    <td class="center">{{ $thankcards[$i]['CountResult']}}</td> 
                </tr> 
            @endfor
        </tbody>
        </table>
  </div>
</body>
</html>