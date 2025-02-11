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

				     <p><a href='my_messages.php'>Messages(2)</a></p>
				     <p><a href='my_posts.php'>My Posts(3)</a></p>
				     <p><a href='edit_profile.php'>Edit My Account</a></p>
				     <p><a href='logout.php'>Logout</a></p>
				     </div>
				  ";
				  ?>
				</div>
			</div>
			<!--user timeline ends-->
			<!--content timeline starts -->
			<div id="content_timeline">
				<form action="home.php?id<?php echo $user_id;?>" method="POST" id="f">
					<h2>What's on your mind</h2>
					<input type="text" name="title" placeholder="Title" size="79" required="required" /><br></br>
					<textarea cols="71" rows="4" name="content" required="required" placeholder="Write description"></textarea></br></br>

					<select name="topic">
						<option>Select Topic</option>
						<?php getTopics();?>
					</select>
					<input type="submit" name="posts" value="Post To Timeline">
				</form>
				<?php insertPost(); ?>
					<h3>All posts in this topic</h3>
					<?php get_cats(); ?>
			</div>
			<!--content timeline ends -->
		</div>
		<!--content area ends -->
	</div>
	<!--container ends here-->	

</body>   

</html>
<?php } ?>