<?php
require_once 'functions.php';
require_once 'conn.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
//连接数据库放在文件里或是引用都正常
 // @$db = new mysqli('localhost','root','','bookmarks');
 //  if (mysqli_connect_errno()) {
 //  	echo "Can't connect database.";
 //  }
// if (!isset($username) && !isset($password)) {
// 	echo "Please filled out your username and password. go back and try again.";
// }
if (!$_POST['username'] || !$_POST['password']) {
	echo "请输入用户名或密码";
	do_html_url('login.php','请重新登录');
}
$query = "select * from user where username = '".$username."' and passwd = '".$password."'";
$result = $db->query($query);
//var_dump($result);
$result_num = $result->num_rows;
 if($result_num>0){  //成功执行SELECT, SHOW, DESCRIBE或 EXPLAIN查询会返回一个mysqli_result 对象，其他查询则返回TRUE
 	                 //SELECT查询后即使是没有找到结果，也会返回对象，所以if判断结果集的行数，才能判断有没有找到
 	$rows = $result->fetch_assoc();
 	$_SESSION['valid_user'] = $username;
 	echo "Welcome ".$rows['username']."";
 }else{
 	echo "对不起，找不到此用户.";
 	do_html_url('login.php','用户名或密码错误，请重新登录');

 	 }
// if (!$result) {
// 	echo "找不到此用户.";
// 	exit();
// }
     do_html_header('会员中心');
     check_valid_user();

     if ($url_array = get_user_urls($_SESSION['valid_user'])) {
          	display_user_urls($url_array);
     }

     //display_user_menu();

     do_html_footer();
?>