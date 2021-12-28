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
	$output="";
	$sql=$conn->query("SELECT * from upload order by date DESC");
	if($sql->num_rows>0)
	{
		$i=1;
		while($row=$sql->fetch_assoc()){
			$id=$row["id"];
			$file=$row["file"];
			$type=$row["type"];
			$username=$row["username"];
			$date=$row["date"];
			$date=date_create($date);
			$date=date_format($date,"M d,Y h:i a");
			if($type=="mp3" || $type=="MP3"){
				$img="music.png";
			}
			else if($type=="mp4" || $type=="MP4"){
				$img="video.png";
			}
			else if($type=="jpg" || $type=="JPG" || $type=="jpeg" || $type=="JPEG" || $type=="png" || $type=="PNG"  || $type=="gif" || $type=="GIF"){
				$img="photo.png";
			}
			else{
				$img="file.png";
			}
			$output.="<tr>
						<td >".$i.".</td>
						<td>
							<img src='".$img."' width='24px' style='vertical-align:middle;'><span style='color:red'>&nbsp;".$file."</span><a href='upload/".$file."' style='float:right' target='_blank' download><img src='download.png' width='24px' style='vertical-align:middle;'></a>
						</td>
						<td>".$username."</td>
						<td>".$date."</td>";
						$i++;
		}
	}else
	{
		$output="<h3 style='text-align:center;color:red'>No files</h3>";
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
  <li><a href="upload.php">File Upload</a></li>
  <li><a href="view.php" class="button">View Files</a></li>
  <?php 
	if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{	
		echo '<li style="float: right;"><a href="logout.php" class="button" style="background-color:red" >Logout</a></li>';
	}
	else
	{
		echo '<li><a href="register.php" >Register</a></li>';
		echo '<li style="float: right;"><a href="login.php" class="button" style="background-color:red" >Login</a></li>';
	}
	?>
</ul>
<h2 style='text-align:center;color:blue'>Download From Cloud</h2>
<div style='margin-top:2%'>
	<table id="file">
	  <tr>
		<th>S.No</th>
		<th>File</th>
		<th>User Name</th>
		<th>uploaded time</th>
	  </tr>
	  <?=$output?>
	</table>
	
	 
</div>
	</body>
</html>