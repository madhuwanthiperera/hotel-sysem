<html>
<?php
$_host = "localhost";  // host name of the MySQl server
$_username = "root";  // user name of the MySQl server
$_password = "123";	// password of the MySQl server
		
	// Create connection to the server
	$conn = mysql_connect($_host, $_username, $_password);

	// Check connection
	if (!$conn) {
    die("Connection failed: " . mysql_connect_error()); 
	// if you could not connect with MYSQL server it will display this message.
	//	check your user name and password
	}
	else{
	echo "Connected successfully"; 
	echo "<br/>";
	}
	$query= mysql_select_db('mydb'); //select database 'mydb'
	if (!$query){
	die("Database Selection Failed  " . mysql_error()); // mysql_error() - display the error  of mysql server as it is
	echo "<br/>";
	}

	if(isset($_POST['btnsubmit'])) //check if the submit button of registration form (btnsubmit) is clicked or not
	{
	
	//catch form values and assign into variables
	$username=$_POST['txtusername'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	
	//insert form values to the database table
	
	$query="INSERT INTO user(username,email,password) VALUES('$username','$email','".md5($password)."')";
	  // sql query
	  //username,email,password- field names of user table
	  //md5() is used for encrypting password
	  
	$result=mysql_query($query);
	if (!$result){
	die("Error Occured,Insertion failed!!  " . mysql_error());
	echo "<br/>";
	}
	else{
	echo "You are Registered Suucessfully!!!";
	echo"<p> <a href='login.php'>Login Here </a> </p>";
	}
	}
	if (isset($_POST['loginsubmit'])){ //check if the submit button of login form (btnsubmit) is clicked or not
		$username=$_POST['loginusername'];
		$password=$_POST['loginpassword'];
	
	
		 //Checking ,is user existing in the database or not
		$query = "SELECT * FROM `user` WHERE username='$username' and password='".md5($password)."'";
		$result = mysql_query($query) ;
		if (!$result){
		die("Error Occured,login failed!!  " . mysql_error());
		echo "<br/>";
		}
		$rows = mysql_num_rows($result);
		if($rows==1){
		
		header("Location: login_success.php"); // Redirect user to login_success.php
		}else{
		echo "<section class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></section>";
		}
		}else{
		}
	mysql_close($conn);
	?> 
	</html>