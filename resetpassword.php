<?php
  require_once 'functions.php';
  session_start();

  do_html_header('忘记密码');

  // if ($_POST['submit']) {
  // 	$username = $_POST['username'];
  // 	if (!username) {
  // 		do_html_url('resetpassword.php','填写用户名');
  // 		exit();
  // 	}
  // 	$db = db_connect();
  // 	$query = "update user set passwd='1111111' where username='".$username."'";
  // 	$result = $db->query($query);
  // 	if ($db->affected_rows > 0) {
  // 		do_html_url('login.php','密码已修改为111111');
  // 	}else{
  // 		echo "密码修改失败";
  // 	}
  // }

  display_forgot_password_form();

  reset_password();

  do_html_footer();
?>