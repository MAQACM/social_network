<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
	header("location:index.php");
}
else{
?>
<!DOCTYPE html>
<html>
   <head>
   	<title>Welcome</title>
   	<link rel="stylesheet" href="styles/home_style.css" media="all">
   	<style>
   		input[type='file']{
   			width:170px; 
   		}
   	</style>
   </head>

<body>
	<!--container starts-->
	<div class="container">
		<!--header_wrap starts-->
		<div id="header_wrap">
			<!--header starts-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
					<strong>Topics:</strong>
					<?php
					$get_topics="select * from topics";
					$run_topics=mysqli_query($con,$get_topics);
					while($row=mysqli_fetch_array($run_topics)){
						$topic_id=$row['topic_id'];
						$topic_title=$row['topic_title'];
						echo"<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";

					}
					?>

				</ul> 
				<form method="GET" action="result.php" id="form1">
					<input type="text" name="user_query" placeholder="search">
					<input type="submit" name="search" value="Search">
				</form>
			</div>
			<!--header ends-->
		</div>
		<!--header_wrap ends-->
		<!--content area starts -->
		<div class="content">
			<!--user timeline starts -->
			<div id="user_timeline">
				<div id="user_details">
				  <?php
				  $user=$_SESSION['user_email'];
				  $get_user="select * from users where user_email='$user'";
				  $run_user=mysqli_query($con,$get_user);
				  $row=mysqli_fetch_array($run_user);
				  $user_id=$row['user_id'];
				  $user_name=$row['user_name'];
				  $user_pass=$row['user_pass'];
				  $user_email=$row['user_email'];
				  $user_gender=$row['user_gender'];
				  $user_image=$row['user_image'];
				  $user_county=$row['user_country'];
				  $register_date=$row['register_date'];
				  $last_login=$row['last_login'];
				  echo"
				     <center><p><img src='user/user_images/$user_image' width='200' height='200'/></p></center>
				     <div id='user_mention'>
				     <p><strong>Name:</strong>$user_name</p>
				     <p><strong>County:</strong>$user_county</p>
				     <p><strong>Last Login:</strong>$last_login</p>
				     <p><strong>Member Since:</strong>$register_date</p>

				     <p><a href='my_messages.php?u_id=$user_id'>Messages(2)</a></p>
				     <p><a href='my_posts.php?u_id=$user_id'>My Posts(3)</a></p>
				     <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
				     <p><a href='logout.php?u_id=$user_id'?>Logout</a></p>
				     </div>
				  ";
				  ?>
				</div>
			</div>
			<!--user timeline ends-->
			<!--content timeline starts -->
			<div id="content_timeline">
					<form action=" " method="post" id="f" class="ff">
					<table>
						<tr align="center">
							<td colspan="6"><h2>Edit Profile</h2></td>
						</tr>
						<tr>
							<td align="right">Name:</td>
							<td><input type="text" name="username" placeholder="username" required="required" value="<?php echo"$user_name";?>"></td>
						</tr>
						<tr>
							<td align="right">Password:</td>
							<td>
								<input type="password" name="password" placeholder="Password" required="required" value="<?php echo"$user_pass";?>">
							</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td><input type="email" name="email" placeholder="abc@example.com" required="required" value="<?php echo"$user_email";?>">
							</td>
						</tr>
						<tr>
							<td align="right">County:</td>
							<td>
								<select name="county" disabled="disabled">
									<option ><?php echo"$user_county";?></option>
									<option>Nairobi</option>
									<option>Embu</option>
									<option>Mombasa</option>
									<option>Kisumu</option>
									<option>Nakuru</option>
									<option>Kisii</option>
									<option>Kakamega</option>
								</select>	
							</td>
						</tr>
						<tr>
							<td align="right">Gender:</td>
							<td>
								<select name="gender" disabled="disabled">
									<option> <?php echo"$user_gender";?></option>
									<option>Male</option>
									<option>Female</option>
								</select>	
							</td>
						</tr>
						<tr>
							<td align="right">Photo:</td>
							<td>
								<input type="file" name="u_image">
							</td>
						</tr>
						<tr align="center">
							<td colspan="6">
								<input type="submit" name="update" value="update"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<!--content timeline ends -->
		</div>
		<!--content area ends -->
	</div>
	<!--container ends here-->	

</body>   

</html>
<?php } ?>