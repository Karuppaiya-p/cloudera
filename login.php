<?php
	session_start();
	if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{
		header("Location: index.php");
	}
	require("database.php"); 
	$error="";
	if(isset($_POST["login"]))
	{
		$username=test_data($_POST["username"]);
		$password=$_POST["password"];
		if(!empty($username) && !empty($password))
		{
			$sql="SELECT * from user where binary username='".$username."' and password='".$password."'";
			$result=$conn->query($sql);
			if(mysqli_num_rows($result)==1)
			{
				while($row = $result->fetch_assoc()) 
				{
					$id=$row["id"];
					$username=$row["username"];
					$password=$row["password"];
					$_SESSION["username"]=$username;
					if(isset($_SESSION["resturi"]) && !empty($_SESSION["resturi"]))
					{
						$resturi=$_SESSION["resturi"];
						$_SESSION["resturi"]="";
						echo "<script>location.replace('".$resturi."');</script>";
					}
					else
					{
						echo "<script>location.replace('index.php');</script>";
					}
				}
			}
			else
			{
				$error="<br><p class='bold text-danger'>Username or Password mismatch</p>";
			}
		}
		else
		{
			$error="<br><p class='bold text-danger'>Please fill empty fields</p>";
		}		
	}
	function test_data($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>

<body class="bg" style="min-height:600px">
<ul>
	<li><a href="index.php" >Home</a></li>
	<li><a href="upload.php" >File Upload</a></li>
	<li><a href="view.php" >View Files</a></li>
	<?php 
		if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{	
		echo '<li style="float: right;"><a href="logout.php" class="button" style="background-color:red" >Logout</a></li>';
	}
	else
	{
		echo '<li><a href="register.php" >Register</a></li>';
		echo '<li style="float: right;"><a href="login.php" class="button">Login</a></li>';
	}
	?>
</ul>
<div style='margin-top:2%'>
<?=$error;?>
<form name="addform" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" novalidate>
	<label for="username"><h5>Username</h5></label>
	<input type="text" name="username" id="username" placeholder="Enter your username" required>
	<label for="password" ><h5>Password</h5></label>
	<input type="password" name="password" id="password" placeholder="Enter your password" required>
	<input type="submit" name="login" value="Submit">
</form>
</div>
	</body>
</html>
</html>