 $(document).ready(function(){ 
	  $dep_id=$("#department_id").val(); 
	  getSubDepartment($dep_id); 
	  $("#sub_department_id").val(sel_value); 

	   getEmployee($dep_id,$("#sub_department_id").val());
	   $("#employee_id").val(sel_emp_val);
 });	
$('#department_id').change(function() { 
  	getSubDepartment($(this).val()); 
  	getEmployee($(this).val(),$("#sub_department_id").val());

 	$("#sub_department_id").val('%'); 
});
$('#sub_department_id').change(function() { 
	$dep_id=$("#department_id").val();
	$sub_dept_id=$(this).val();
	getEmployee($dep_id,$sub_dept_id); 
});  

function getSubDepartment($id){ 
	$("#sub_department_id").html('');
	$("#sub_department_id").append(new Option('All', '%'));
	 
	$.each(subdepartments, function(key, item){ 
		if(item.Dept_Id ==$id){
			$("#sub_department_id").append(new Option(item.Sub_Dept_Name, item.Sub_Dept_Id));
		} 
    });     
} 
function getEmployee($dep_id,$sub_dept_id){  
	if (typeof employees != 'undefined'){
		$("#employee_id").html('');
		$("#employee_id").append(new Option('All', '%')); 
		$.each(employees, function(key, item){ 
			if($dep_id !="" && $sub_dept_id=="%"){
				if(item.dept_id ==$dep_id){
					$("#employee_id").append(new Option(item.Emp_Name, item.Emp_Id));
				} 
			}else if($dep_id !="" && $sub_dept_id !="%"){ 
				if(item.dept_id ==$dep_id && item.sub_dept_id==$sub_dept_id){ 
					$("#employee_id").append(new Option(item.Emp_Name, item.Emp_Id));
				}
			}
			
	    }); 
	}
}