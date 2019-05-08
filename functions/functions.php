<?php
$con=mysqli_connect("localhost","root","1234","social_network")or die("connection was not established");
//functions for getting the topics
function getTopics(){
	global $con;
	$get_topics="select * from topics";
	$run_topics=mysqli_query($con,$get_topics);
	while($row=mysqli_fetch_array($run_topics)){
		$topic_id=$row['topic_id'];
		$topic_title=$row['topic_title'];
		echo"<option value='$topic_id'>$topic_title</option>";
}
}

//functions for inserting posts.
function insertPost(){
if(isset($_POST['posts'])){
		global $con;
	     //getting details from session
         $user_com=$_SESSION['user_email'];
		  $get_user_com="select * from users where user_email='$user_com'";
	      $run_user_com=mysqli_query($con,$get_user_com);
		  $row_com=mysqli_fetch_array($run_user_com);
		  $user_id_com=$row_com['user_id'];
		$title=addslashes($_POST['title']);
		$content=addslashes($_POST['content']);
		$topic=$_POST['topic'];
		if($content==''){
			echo"<h2>description area cannot be left empty</h2>";
			exit();
		}
		else{
		$insert="insert into posts(user_id,topic_id,post_title,post_content,post_date) values ('$user_id_com','$topic','$title','$content',NOW())";
		$run=mysqli_query($con,$insert);
		if($run){
			echo"<h3>Posted to timeline,Looks great</h3>";
			$update="update users set posts='yes' where user_id='$user_id_com'";
            $run_update=mysqli_query($con,$update);
		}
	}
	}
}
//function for displaying posts
function get_posts(){
	global $con;
	$per_page=5;
	if (isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}
	$start_from=($page-1)*$per_page;
	$get_posts="select * from posts order by 1 Desc Limit $start_from,$per_page";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
        $post_title=$row_posts['post_title'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
        //getting the user who has posted the tread
        $user="select * from users where user_id='$user_id' and posts='yes'";
        $run_user=mysqli_query($con,$user);
        $row_user=mysqli_fetch_array($run_user);
        $user_name=$row_user['user_name'];
        $user_image=$row_user['user_image'];
        //now displaying all at once
        echo"<div id='posts'>
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>see replies or Reply to This</button></a>
        </div><br>
        ";
	}
	include("pagination.php");
}
function single_post(){
	global $con;
	if(isset($_GET['post_id'])){
		$get_id=$_GET['post_id'];
		$get_posts="select * from posts where post_id='$get_id'";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
        $post_title=$row_posts['post_title'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
        //getting the user who has posted the tread
        $user="select * from users where user_id and user_id='$user_id'";
        $run_user=mysqli_query($con,$user);
        $row_user=mysqli_fetch_array($run_user);
        $user_name=$row_user['user_name'];
        $user_image=$row_user['user_image'];
         //getting details from session
         $user_com=$_SESSION['user_email'];
		  $get_user_com="select * from users where user_email='$user_com'";
	      $run_user_com=mysqli_query($con,$get_user_com);
		  $row_com=mysqli_fetch_array($run_user_com);
		  $user_id_com=$row_com['user_id'];
        //now displaying all at once
        echo"<div id='posts'>
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        </div> 
        ";
         include("comments.php");
         echo"      
        <form action='' method='POST' id='reply'>
        <div>
        <textarea cols='50' rows='5' name='comment' placeholder='reply'></textarea>
        <input type='submit' name='reply' value='Reply to this'><br>
        </div>
        </form>
        ";
        if(isset($_POST['reply'])){
        //getting details from session
           	$comment=$_POST['comment'];
        	$insert="insert into comments(post_id,user_id,comment,date) values('$post_id','$user_id_com','$comment',NOW())";
        	$run=mysqli_query($con,$insert);
        	//echo"send succeffully $user_id_com";
        	echo"<script>window.open('single.php?post_id=$get_id','_self')</script>"; 
        
        }
	}
}
}
//gets all the posts on that topic
function get_cats(){
	global $con;
	$per_page=5;
	if (isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}
	$start_from=($page-1)*$per_page;
	if(isset($_GET['topic'])){
		$topic_id=$_GET['topic'];
	}
	$get_posts="select * from posts where topic_id='$topic_id'order by 1 Desc Limit $start_from,$per_page";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
        $post_title=$row_posts['post_title'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
        //getting the user who has posted the tread
        $user="select * from users where user_id='$user_id' and posts='yes'";
        $run_user=mysqli_query($con,$user);
        $row_user=mysqli_fetch_array($run_user);
        $user_name=$row_user['user_name'];
        $user_image=$row_user['user_image'];
        //now displaying all at once
        echo"<div id='posts'>
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>see replies or Reply to This</button></a>
        </div><br>
        ";
	}
	include("pagination.php");
}
//gets search results
function get_results(){
	global $con;
	if(isset($_GET['search'])){
		$search_term=addslashes($_GET['user_query']);
	}
	$get_posts="select * from posts where post_title like'%$search_term%' or post_content like '%$search_term%'order by 1 Desc Limit 10";
	$run_posts=mysqli_query($con,$get_posts);
	$count_result=mysqli_num_rows($run_posts);
	if($count_result==0){
		echo"<h3 style='background:black; color:white; padding:10px'>No results found!</h3>";
		exit();
	}

	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
        $post_title=$row_posts['post_title'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
        //getting the user who has posted the tread
        $user="select * from users where user_id='$user_id' and posts='yes'";
        $run_user=mysqli_query($con,$user);
        $row_user=mysqli_fetch_array($run_user);
        $user_name=$row_user['user_name'];
        $user_image=$row_user['user_image'];
        //now displaying all at once
        echo"<div id='posts'>
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?$user_id'>$user_name</a></h3>
        <h3>$post_title</h3>
        <p>$post_date</p>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style='float:right;'><button>see replies or Reply to This</button></a>
        </div><br>
        ";
	}
	//include("pagination.php");
}
?>