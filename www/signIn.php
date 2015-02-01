
<html>
<body>
<?php
	$c_user = "admin";
	$pwd = "admin";
	$correct = false;
	
	$servername = "localhost";
	$s_usrnm = "root";
	$s_pwd = "admin";
	$db = "logintest";
	
	//read user info scrub cross-cite script
	$passed_user = htmlspecialchars($_POST[user]);
	$passed_pwd = htmlspecialchars($_POST[pass]);
	
	//clear whitespace
	$passed_user = trim($passed_user);
	$passed_pwd = trim($passed_pwd);
	
	// Create connection
	$conn = new mysqli($servername, $s_usrnm, $_spwd, $db);
	
	// Check connection
	if ($conn->connection_error) 
	{
		die("Connection failed: " . $conn->connect_error);
		//die("servers in maintenance")
	}
	
	//prepare to prevent sql injection
	$stmt =  $conn->prepare('SELECT UserName, Email, Password FROM tb1 WHERE (user_name = ? OR email = ?) AND password = ?');
	$stmt ->bind_param('sss',$passed_user,$passed_user,$passed_pwd);
	
	$stmt->execute();
	
	$result = $stmt->get_result();
 
	if($result->num_rows > 0)
	{
		while($row=$result->fetch_assoc())
		{
			echo "user: " . $row["UserName"] . " has logged on<br>";
		}
	}
	else
	{
		echo "failed to log in";
	}
	
	$conn->close();	
?>

</body>
</html>