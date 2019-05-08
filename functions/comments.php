<?php
$get_id=$_GET['post_id'];
$get_com="select * from comments where post_id='$get_id order by date'";
 $run_com=mysqli_query($con,$get_com);
 while($row=mysqli_fetch_array($run_com)){
 	$com=$row['comment'];
 	$user_id=$row['user_id'];
 	$run_user="select user_name from users where user_id='$user_id'";
 	$run_name=mysqli_query($con,$run_user);
 	$row_user=mysqli_fetch_array($run_name);
 	$com_name=$row_user['user_name'];
 	//$com_name=$row['comment_author'];
 	$date=$row['date'];
 	echo"
    <div id='comments'> 
    <h3>$com_name</h3><span>$date</span>
    <p>$com</p>
    </div>
 	";
 }
  
?> 