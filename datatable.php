<link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="datatable/jquery-1.12.0.min.js"></script>
<script type="text/javascript" language="javascript" src="datatable/jquery.dataTables.min.js"></script>
<script>    
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
    //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
  });
} );
 
  </script>