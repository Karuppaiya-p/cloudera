<?php
	session_start();
	if(!isset($_SESSION["username"]) && !isset($_SESSION["username"]))
	{
		$_SESSION["resturi"]=$_SERVER["REQUEST_URI"];
		die(header('Location: login.php'));
	}
	else
	{
		$_SESSION["resturi"]="";
	}
	require("database.php");
	$out="";
	if(isset($_POST["send"]))
	{
		if(is_uploaded_file($_FILES['Filedata']['tmp_name']))
		{
			$username=$_SESSION["username"];
			$uploadDir ="upload/";
			$file_ext=pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
				$filename=md5(uniqid()).".".$file_ext;
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$targetFile = $uploadDir.$filename;
				move_uploaded_file($tempFile, $targetFile);
				if($conn->query("insert into upload (`username`,`file`,`type`)VALUES('$username','$filename','$file_ext')"))
				{
					echo "<script>location.replace('view.php');</script>";
				}
		}
		else
		{
			$out="*Please give all inputs";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="bg" style="min-height:600px">
<ul>
  <li><a href="index.php" >Home</a></li>
  <li><a href="upload.php" class="button">File Upload</a></li>
  <li><a href="view.php" >View Files</a></li>
  <?php 
	if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{	
		echo '<li style="float: right;"><a href="logout.php" class="button" style="background-color:red" >Logout</a></li>';
	}
	else
	{
		echo '<li style="float: right;"><a href="login.php" class="button" style="background-color:red" >Login</a></li>';
	}
	?>
</ul>
<div style='margin-top:2%'>
	<?=$out?>
	 <form action = "<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data">
		<h3 style="text-align:center;color:red">Upload your file on cloud. And you can download the file at any where. </h3>
		<h4 style="text-align:center;">You are logined as <?=$_SESSION["username"]?></h4>
		Browse File<input type="file" name="Filedata">
		<input type="submit" name="send" value="upload">
	</form>
</div>
	</body>
</html>