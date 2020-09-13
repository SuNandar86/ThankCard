 $(document).ready(function(){ 
	  $dep_id=$("#department_id").val(); 
	  getSubDepartment($dep_id); 
   
	  $("#sub_department_id").val(sel_value);
 });	
$('#department_id').change(function() { 
  	getSubDepartment($(this).val(),'');
 	 $("#sub_department_id").val('');
}); 
function getSubDepartment($id){ 
	$("#sub_department_id").html('');
	$("#sub_department_id").append(new Option('Select Sub Department', '%'));
	 
	$.each(subdepartments, function(key, item){ 
		if(item.Dept_Id ==$id){
			$("#sub_department_id").append(new Option(item.Sub_Dept_Name, item.Sub_Dept_Id));
		} 
    }); 
 } 