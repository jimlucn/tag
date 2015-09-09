<?php
  require_once 'functions.php';
  session_start();

  do_html_header('删除标签');

  check_valid_user();

  $del_url = $_POST['del_me'];

  if (!filled_out($_POST)) {
  	echo "选择要删除的标签";
  }else{
  	del_bm($del_url);
  }
?>