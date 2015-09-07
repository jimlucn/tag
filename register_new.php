<?php
  require_once 'functions.php';

  $username = $_POST['username'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $email = $_POST['email'];

  session_start();

  try{
  	if (!filled_out($_POST)) {
  		throw new Exception("You have not filled the form out correctly- please go back and try again");  		
  	}
  	if (!vaild_email($email)) {
  		throw new Exception("That is not a valid email address. Please go back and try again");  		
  	}
  	if ($password1 != $password2) {
  		throw new Exception("The passwords you enterd do not match - please go back and try again");  		
  	}
  	if (strlen($password1) < 6 || strlen($password1) > 16) {
  		throw new Exception("Your password must be between 6 and 16 characters. Please go back and try again");  		
  	}
  	register($username, $email, $password1);

  	$_SESSION['valid_user'] = $username;

  	do_html_header('注册成功');

  	echo "Your REgistration was successful. Go to the members page to start setting up your bookmars!";
  	
  	do_html_url('member.php','Go to members page');

  	do_html_footer();
  }
  catch (Exception $e){
  	do_html_header('Problem:');
  	echo $e->getMessage();
  	do_html_footer();
  	exit;
  }
?>