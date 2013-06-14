<html>
<head>
<style type="text/css" src='bootstrap.css'></style>
<style type="text/css" src='bootstrap-responsive.css'></style>
<script type="text/javascript" src = 'jquery.js'></script>
<script type="text/javascript" src = 'jquery.zclip.js'></script>
<script>
function copy(value1, value2, value3){
		value = "Account:" + value1 + " Char Name: " + value2 + " Password:" + value3;
		window.prompt ("Copy to clipboard: Ctrl+C, Enter", value);
		return false;
	}
$(document).ready(function(){

	$("#rowform").submit(function() {
		if(confirm('Are you sure?')){
			//process delete
			var serializedData = $('#rowform').serialize();
			 $.ajax({
	        url: "process.php",
	        type: "post",
	        data: serializedData + '&type=delete'
	    	}).done(function(msg){

	  		 $('#results').html(msg);
		  	});

			 //reload the realm's dropdown
			 $.ajax({
	        url: "process.php",
	        type: "post",
	        data: serializedData + '&type=selectRealms'
	    	}).done(function(msg){

	  		 $('#realm').html(msg);
		  	});
		}
		
	  return false;
	});
	$("#form1").submit(function() {
		//insert new product
		var serializedData = $('#form1').serialize();

	    $.ajax({
	        url: "process.php",
	        type: "post",
	        data: serializedData + '&type=select'
	    }).done(function(msg){

	  	 $('#results').html(msg);
		  });
	  return false;
	});
});
</script>

</head>
<body>
<input type = "hidden" name = 'tocopy' id = "tocopy">
<form id ='form1'>

<input type = "text" name = 'productname' id = "productname"><BR>
<select name='realm' id ='realm'>
<?php 
	$con=mysqli_connect("localhost","root","","inventory");

	$q = mysqli_query($con,"select distinct realm from products");
	while($row = mysqli_fetch_assoc($q)){
		echo '<option value="'.$row['realm'].'">'.$row['realm'].'</option>';

	}
	
?>
</select>

 <input type='submit'>
</form>
<form id = rowform>
<div id ='results'>

</div>
</form>
</body>

</html>