<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>The Database Seeder Application</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://harvesthq.github.io/chosen/chosen.css">
    
	
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
   	  	   	 <input type="text" name="db_host" id="db_host" class="form-control" required >
   	  	   	 <label>Database Name:</label>
   	  	   	 <input type="text" name="db_name" id="db_name" class="form-control" required >
   	  	   	 <label>Table Name:</label>
   	  	   	 <input type="text" name="db_table" id="db_table" class="form-control" required >
   	  	   	 <label>Username:</label>
   	  	   	 <input type="text" name="db_username" id="db_username" class="form-control" required >
   	  	   	 <label>Password</label>
   	  	   	 <input type="text" name="db_password" id="db_password" class="form-control" >
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
		   	  	      <input type="text" placeholder="Column Name" class="form-control" name="db_column[]" required>  
		   	  	    </div>
		   	  	    <div class="col-md-4">
		   	  	   	  <select class='form-control db_data_type_select chosen-select' name='db_data_type[]' id='" + i +"'><optgroup label='Basics'><option value='name'>Name</option><option value='address'>Address</option><option value='text'>Text</option><option value='integer'>Integer</option><option value='float'>Float</option></optgroup><optgroup label='Person'><option value='title'>Title</option><option value='titleMale'>Title Male</option><option value='titleFemale'>Title Female</option><option value='suffix'>Suffix</option><option value='firstNameMale'>First Name Male</option><option value='firstNameFemale'>First Name Female</option><option value='lastName'>Last Name</option></optgroup><optgroup label='Address'><option value='cityPrefix'>City Prefix</option><option value='secondaryAddress'>Secondary Address</option><option value='state'>State</option><option value='stateAbbr'>State Abbreviation</option><option value='citySuffix'>City Suffix</option><option value='streetSuffix'>Street Suffix</option><option value='buildingNumber'>Building Number</option><option value='city'>City</option><option value='streetName'>Street Name</option><option value='streetAddress'>Street Address</option><option value='postcode'>Post Code</option><option value='address'>Address</option><option value='country'>Country</option><option value='latitude'>Latitude</option><option value='longitude'>Longitude</option></optgroup><optgroup label='Company'><option value='company'>Company Name</option><option value='jobTitle'>Job Title</option></optgroup><optgroup lable='DateTime'><option value='date'>Date</option><option value='time'>Time</option><option value='month'>Month</option><option value='year'>Year</option></optgroup><optgroup label='Payment'><option value='creditCardType'>Credit Card Type</option><option value='creditCardNumber'>Credit Card Number</option><option value='creditCardExpirationDate'>Credit Card Expiration Date</option><option value='creditCardExpirationDateString'>Credit Card Expiration Date String</option><option value='swiftBicNumber'>Swift Code</option></optgroup><optgroup label='Internet'><option value='email'>Email</option><option value='username'>Username</option><option value='domainName'>Domain Name</option></optgroup><optgroup label='Misc'><option value='emoji'>Emoji</option><option value='currencyCode'>Currency Code</option><option value='languageCode'>Language Code</option><option value='colorName'>Color Name</option><option value='hexColor'>Hex Color</option><option value='rgbColor'>RGB Color</option></optgroup></select>
		   	  	    </div>
		   	  	    <div class="col-md-4">
		   	  	   	  <input type="number" class="form-control" name="db_row_number[]" required>	
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
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
	$(document).ready(function() {
		// Chosen JS Loading Doc
		$(".chosen-select").chosen({width: "223px"});

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
		    	DOM_Transform += "<br/><div class='col-md-4'><input placeholder='Column Name' name='db_column[]' class='form-control' type='text' value='" + columns[i] +"' required /> </div> " +
		    	"<div class='col-md-4'> <select class='form-control db_data_type_select chosen-select' name='db_data_type[]' id='" + i +"'><optgroup label='Basics'><option value='name'>Name</option><option value='address'>Address</option><option value='text'>Text</option><option value='integer'>Integer</option><option value='float'>Float</option></optgroup><optgroup label='Person'><option value='title'>Title</option><option value='titleMale'>Title Male</option><option value='titleFemale'>Title Female</option><option value='suffix'>Suffix</option><option value='firstNameMale'>First Name Male</option><option value='firstNameFemale'>First Name Female</option><option value='lastName'>Last Name</option></optgroup><optgroup label='Address'><option value='cityPrefix'>City Prefix</option><option value='secondaryAddress'>Secondary Address</option><option value='state'>State</option><option value='stateAbbr'>State Abbreviation</option><option value='citySuffix'>City Suffix</option><option value='streetSuffix'>Street Suffix</option><option value='buildingNumber'>Building Number</option><option value='city'>City</option><option value='streetName'>Street Name</option><option value='streetAddress'>Street Address</option><option value='postcode'>Post Code</option><option value='address'>Address</option><option value='country'>Country</option><option value='latitude'>Latitude</option><option value='longitude'>Longitude</option></optgroup><optgroup label='Company'><option value='company'>Company Name</option><option value='jobTitle'>Job Title</option></optgroup><optgroup lable='DateTime'><option value='date'>Date</option><option value='time'>Time</option><option value='month'>Month</option><option value='year'>Year</option></optgroup><optgroup label='Payment'><option value='creditCardType'>Credit Card Type</option><option value='creditCardNumber'>Credit Card Number</option><option value='creditCardExpirationDate'>Credit Card Expiration Date</option><option value='creditCardExpirationDateString'>Credit Card Expiration Date String</option><option value='swiftBicNumber'>Swift Code</option></optgroup><optgroup label='Internet'><option value='email'>Email</option><option value='username'>Username</option><option value='domainName'>Domain Name</option></optgroup><optgroup label='Misc'><option value='emoji'>Emoji</option><option value='currencyCode'>Currency Code</option><option value='languageCode'>Language Code</option><option value='colorName'>Color Name</option><option value='hexColor'>Hex Color</option><option value='rgbColor'>RGB Color</option></optgroup></select></div> " +
		    	"<div class='col-md-4'><input placeholder='Number of rows' name='db_row_number[]' class='form-control' type='number' value='" + row_number[i] +"' required /> </div><br/>";
                
	            
	            if(data_type[i] != " ") {
		    	  DOM_Select_id_text += '#' + i + ' option[value='+ data_type[i]+'], ';
		        }
		    	
		    }

		    DOM_Select_id_text = DOM_Select_id_text.substring(0, DOM_Select_id_text.length-2); // remove last ,
		    $("#data-rows").html(DOM_Transform);
            console.log(DOM_Select_id_text);
		    $(DOM_Select_id_text).attr('selected', 'selected');
		    $(".chosen-select").chosen({width: "223px"});

		   e.preventDefault();
       });

	})
</script>
</html>