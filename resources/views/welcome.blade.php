
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Password</th> 
            </tr>
        </thead>
        <tbody>
           <?php
                for($i=0;$i<count($data);$i++){
            ?>
            <tr>
                <td>{{$data[$i]['user_Name'] }}</td>
                <td>{{$data[$i]['password'] }}</td> 
            </tr>
            <?php                 
                }
            ?>
                 
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Password</th>
                 
            </tr>
        </tfoot>
    </table><!DOCTYPE html>
    <script type="text/javascript"> 
 $(document).ready(function () {
  $('#dtBasicExample').DataTable({
    "paging": true ,// false to disable pagination (or any other option)
    "iDisplayLength": 5
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>