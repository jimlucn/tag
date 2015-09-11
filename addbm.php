<?php
  require_once 'functions.php';
  session_start();
  $bm = $_POST['bm'];
  do_html_header('添加标签');
  //判断是否登录
  // if (!$_SESSION['valid_user']) {
  // 	do_html_url('login.php','您还没有登录，请登录');
  // }
  check_valid_user();
  //判断是否点击按钮，是否输入内容
  if($_POST[submit]){
  	if (!isset($bm)) {
  		do_html_url('addbm.php','标签不能为空');
  		exit();
  	}
  $username = $_SESSION['valid_user'];
  $bm = $_POST['bm'];
  $db = db_connect();
  $query = "insert into bookmark values ('".$username."','".$bm."')";
  $result = $db->query($query);
  if (!result) {
  	echo "添加标签失败";
  }else{
  	do_html_url('member.php','添加成功了');
  }
}
  
?>
<form action="?" method="post">
	标签：<input type="text" name="bm" value="http://">
	<input type="submit" name="submit" value="添加">
</form>
<?php
   display_user_menu();
   echo $bm_table;
?>