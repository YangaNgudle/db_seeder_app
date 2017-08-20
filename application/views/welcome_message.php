<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>The Database Seeder Application</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	
</head>
<body>
   <div class="container">
   	  <h1 class="text-center">Database Seeder Application</h1>
   	  <hr/>
   	  <form action="index.php/Seed/" method="POST">
   	  	<div class="row">
   	  	   <div class="col-md-4">

   	  	   </div>
   	  	   <div class="col-md-4">
   	  	   	 <label>Host:</label>
   	  	   	 <input type="text" name="db_host" id="db_host" class="form-control">
   	  	   	 <label>Database Name:</label>
   	  	   	 <input type="text" name="db_name" id="db_name" class="form-control">
   	  	   	 <label>Table Name:</label>
   	  	   	 <input type="text" name="db_table" id="db_table" class="form-control">
   	  	   	 <label>Username:</label>
   	  	   	 <input type="text" name="db_username" id="db_username" class="form-control">
   	  	   	 <label>Password</label>
   	  	   	 <input type="text" name="db_password" id="db_password" class="form-control">
   	  	   </div>
   	  	   <div class="col-md-4">
   	  	   	
   	  	   </div>
   	  	</div>
   	  	<hr/>

        <div class="row" id="seeder">
            <div class="col-md-2">
           	
            </div>
            <div class="col-md-8">
           	  <div class="row">
                <div id="data-rows">
                    <br/>
		   	  	    <div class="col-md-4">
		   	  	      <input type="text" placeholder="Column Name" class="form-control" name="db_column[]" >  
		   	  	    </div>
		   	  	    <div class="col-md-4">
		   	  	   	  <select class="form-control db_data_type_select" name="db_data_type[]">
		   	  	   	  	<option value='name'>Name</option>
		   	  	   	  	<option value='address'>Address</option>
		   	  	   	  	<option value='text'>Text</option>
		   	  	   	  	<option value='integer'>Integer</option>
		   	  	   	  	<option value='float'>Float</option>
		   	  	   	  </select>	
		   	  	    </div>
		   	  	    <div class="col-md-4">
		   	  	   	  <input type="text" placeholder="Number of rows" class="form-control" name="db_row_number[]" >	
		   	  	    </div>
	   	  	    </div>
	   	  	  </div>
	   	  	  <br/>
	   	  	  <button id="seeder_new_row" class="btn btn-primary btn-small pull-right">Add</button>
	   	  	  <br/>
	   	  	  <br/>
	   	  	  <br/>
	   	  	  <br/>
	   	  	  <button type="submit" id="populate_seeder" class="btn btn-warning" style="width: 100%">Populate</button>
           </div>
           <div class="col-md-2">
           	
           </div>
        </div>
   	  </form>
   </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
	$(document).ready(function() {
	    //
	    // var db_data = {
	    // 	'column': [],
	    // 	'data_type': [],
	    // 	'row_number': [],
	    // }; 

	    
	    // Add a new row but persist exisiting data...
	    $('#seeder').on('click', '#seeder_new_row', function(e) {
	       var columns = [];
		   var data_type = [];
		   var row_number = [];

		   $('#data-rows *').filter(':input').each(function(){
			   switch($(this).attr('name')) {
			   	  case 'db_column[]':
                    columns.push($(this).val());
			   	    break;
			   	  case 'db_data_type[]':
                    data_type.push($(this).val());
			   	    break;
			   	  case 'db_row_number[]':
                    row_number.push($(this).val());
			   	    break;
			   }
			    

			});
            
            // Add empty column at the end
            columns.push(" ");
            data_type.push(" ");
            row_number.push(" ");

		    var DOM_Transform = '';
		    var DOM_Select_id_text = '';
           //class="form-control" name="db_data_type[]"
		    for(var i = 0; i < columns.length; i++ ) {
		    	console.log(i);
		    	DOM_Transform += "<br/><div class='col-md-4'><input placeholder='Column Name' name='db_column[]' class='form-control' type='text' value='" + columns[i] +"' /> </div> " +
		    	"<div class='col-md-4'> <select class='form-control db_data_type_select' name='db_data_type[]' id='" + i +"'><option value='name'>Name</option><option value='address'>Address</option><option value='text'>Text</option><option value='integer'>Integer</option><option value='float'>Float</option></select></div> " +
		    	"<div class='col-md-4'><input placeholder='Number of rows' name='db_row_number[]' class='form-control' type='text' value='" + row_number[i] +"' /> </div><br/>";
                
	            
	            if(data_type[i] != " ") {
		    	  DOM_Select_id_text += '#' + i + ' option[value='+ data_type[i]+'], ';
		        }
		    	
		    }

		    DOM_Select_id_text = DOM_Select_id_text.substring(0, DOM_Select_id_text.length-2); // remove last ,
		    $("#data-rows").html(DOM_Transform);
            console.log(DOM_Select_id_text);
		    $(DOM_Select_id_text).attr('selected', 'selected');

		   e.preventDefault();
       });

	})
</script>
</html>