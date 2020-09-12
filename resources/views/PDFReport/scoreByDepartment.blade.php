<html>
<head>
 <title>ThankCard Score By Department</title> 
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
  <h3 style="text-align: center;">ThankCard Score By Department</h3>
  <div>
        <table class="pdf_data" style="width: 100%;">
	       <thead>
	       		<tr>
	                <th>No</th>
	                <th>Department</th>
	                <th>Sub Department </th> 
	                <th>From</th> 
	                <th>To</th> 
	                <th>Total Score</th> 
            	</tr>
	       </thead>
	       <tbody>
	       		@for($i=0;$i<count($thankcards);$i++)
                <tr>
                    <td>{{$i+1}}</td>  
                    <td>{{ $thankcards[$i]['Dept_Name']}}</td>
                    <td>{{ $thankcards[$i]['Sub_Dep_Name']}}</td> 
                    <td>{{date('d-m-Y',strtotime($thankcards[$i]['f_date']))}}</td>
                    <td>{{date('d-m-Y',strtotime($thankcards[$i]['t_date']))}}</td>
                    <td>{{ $thankcards[$i]['CountResult']}}</td> 
                </tr> 
            	@endfor
	       </tbody> 
        </table>
  </div>
</body> 
</html>