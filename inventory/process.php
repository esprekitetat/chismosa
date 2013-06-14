<?php 
session_start();
  define('HOST','localhost'); 
  define('USER','root'); 
  define('PASSWORD',''); 
  define('DATABASE','inventory'); 

if(isset($_POST['type'])){
	// which task to do
		switch($_POST['type']){
			case 'select': selectProducts(); break;
			case 'selectRealms': selectRealms(); break;
			case 'delete': deleteProducts(); break;
		}

}
function selectRealms(){

	$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	$q = mysqli_query($con,"select distinct realm from products");
	while($row = mysqli_fetch_assoc($q)){
		echo '<option value="'.$row['realm'].'">'.$row['realm'].'</option>';
	}
}
function deleteProducts(){
	$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	foreach ($_POST as $key => $val){
		if(substr($key, 1, 4)){
			$query = "delete from products where id = " . substr($key, 5);
			$q = mysqli_query($con,$query);
		}
		
	}

	selectProducts();

}
function selectProducts(){
	$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	//store the search value in a session so upon deleting will still query the previous search
	if(isset($_POST['realm'])){
		$query = "select * from products where realm like '%".$_POST['realm']."%' and name like '%".$_POST['productname']."%'";
		$_SESSION['realm'] = $_POST['realm'];
		$_SESSION['productname'] = $_POST['productname'];
	}
	else{
		$query = "select * from products where realm like '%".$_SESSION['realm']."%' and name like '%".$_SESSION['productname']."%'";

	}
	$q = mysqli_query($con,$query);

	
	if(mysqli_num_rows($q)!=0){
		echo '<table border=1>';
		echo '<tr><th></th><th>Name</th><th>Realm</th><th>Account</th><th>Password</th><th>Character Name</th><Th></th></tr>';
		while($row = mysqli_fetch_assoc($q)){
			$tocopy = "Account:".$row['account']." Char Name:".$row['char_name']." Password:".$row['password'];
			echo "<tr>";
			echo "<TD><input type='checkbox' id='todel".$row['id']."' name='todel".$row['id']."'></td>";
			echo '<td>'.$row['name'].'</td><td>'.$row['realm'].'</td><td><P id=atocopy'.$row['id'].'>'.$row['account'].'</P></td>
			<td><P id=btocopy'.$row['id'].'>'.$row['password'].'</P></td><td><P id=ctocopy'.$row['id'].'>'.$row['char_name'].'</P></td>';
			echo '<Td><button type=button onclick=copy("'.$row['account'].'","'.$row['char_name'].'","'.$row['password'].'") ">Copy</button></td>';
			echo '</tr>';

		}
		echo '</table>';
		echo '<button type="Submit" >Submit</button>';
	}
	else{
		echo '<table border=1>';
		echo '<tr><td>No results found.</td></tr>';
		echo '</table>';
	}

}

?>