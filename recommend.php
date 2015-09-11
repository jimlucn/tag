<?php
  require_once 'functions.php';
  session_start();
  $username = $_SESSION['valid_user'];

  do_html_header('推荐书签');

  check_valid_user();

  dispaly_recommend_bm($username);

  display_user_menu();

  do_html_footer();
?>