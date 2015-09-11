<?php
  require_once 'functions.php';
  session_start();

  do_html_header('修改密码');


  check_valid_user();
  $old_password = $_POST['old_password'];
  $password1 = $_POST['new_password1'];
  $password2 = $_POST['new_password2'];
  $username = $_SESSION['valid_user'];


  if ($_POST['submit']) {
  	if (!filled_out($_POST)) {
  		do_html_url('changepw.php','请填写密码');
  		exit();
  	}
  	if (!check_password($username,$old_password)) {
  		do_html_url('changepw.php','原始密码错误');
  		exit();
  	}
  	if ($password1 != $password2) {
  		do_html_url('changepw.php','两次输入的密码不一致');
  		exit();
  	}
  	if(change_new_password($username,$password1)){
  		do_html_url('login.php','密码修改成功');
  		//完善：修改密码后Logout再登录
  	}else{
  		do_html_url('changepw.php','密码修改失败');
  	}

    //测试用的
  	// $db = db_connect();  
   //  $query = "updat user set passwd='".$password1."' where username='1111'";
   //  $result = $db->query($query);
   //  print_r($db->affected_rows); //返回-1

  }


  display_changepassword_form();

  display_user_menu();

?>