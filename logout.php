<?php
  require_once 'functions.php';
  session_start();

  do_html_header('登出');

  check_valid_user();

  if(session_destroy()){
  	do_html_url('login.php','已登出');
  }else{
  	do_html_url('login.php','登出失败');
  } 

?>