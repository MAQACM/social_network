<?php
include("includes/connection.php");
if(isset($_POST['sign_up'])){
         $name=mysqli_real_escape_string($con,$_POST['username']);
         $pass=mysqli_real_escape_string($con,$_POST['password']);
         $email=mysqli_real_escape_string($con,$_POST['email']);
         $county=mysqli_real_escape_string($con,$_POST['county']);
         $gender=mysqli_real_escape_string($con,$_POST['gender']);
         $dob=mysqli_real_escape_string($con,$_POST['DOB']);
         $date=date("m-d-y");
         $status="unverified";
         $posts="No";

         $get_email="select * from users where user_email='$email'";
         $run_email=mysqli_query($con,$get_email);
         $check=mysqli_num_rows($run_email);
         if($check==1){
         	echo"<script>alert('This email is registered')</script>";
         	exit();  
         }
         if(strlen($pass)<8){
         	echo"<script>alert('password should be a minimum of 8 characters')</script>";
         	exit();
         }
         else{
         	$insert="insert into users(user_name,user_pass,user_email,user_country,user_gender,user_dob,user_image,register_date,last_login,status,posts) values('$name','$pass','$email','$county','$gender','$dob','default.jpg',NOW(),NOW(),'$status','$posts')";
         }
        $run_insert=mysqli_query($con,$insert);
        if($run_insert){
        	$_SESSION['user_email']=$email;
        	echo"<script>alert('Registration Successful')</script>";
        	echo"<script>window.open('home.php','_self')</script>";
        } 
	}
?>