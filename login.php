<?php
session_start();
include("includes/connection.php");
if(isset($_POST['login'])){
         $email=mysqli_real_escape_string($con,$_POST['emaillg']);
         $pass=mysqli_real_escape_string($con,$_POST['pass']);

         $get_user="select * from users where user_email='$email' and user_pass='$pass'";
         $run_user=mysqli_query($con,$get_user);
         $check=mysqli_num_rows($run_user);
         if($check==1){
         	$_SESSION['user_email']=$email;
         	echo "<script>window.open('home.php','_self')</script>";

         }
         else{
         	echo "<script>alert('password or email is incorrect')</script>";
         }
	      
         }
?>