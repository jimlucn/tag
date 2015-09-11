<?php
   function do_html_header($tittle){  //显示html头文件函数
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $tittle;?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 <?php	  
  }
 ?>


<?php
  function display_site_info(){  //显示html网站首页信息函数
?>
    <h1>PHPbookmark</h1>
    <ul>
    	<li>Store your bookmarks online with us!</li>
    	<li>See what other users use!</li>
    	<li>Share your favorite links with others!</li>
    </ul>
  <p><a href="register_form.php">Not a member?</a></p>
 <?php	  
  }
 ?>


<?php
  function display_login_form(){  //显示登录表单函数
?>
    <h2>Members log in here:</h2>
    <form class="form-inline" action="member.php" method="post">
      <div class="form-group">
    	<label>用户名</label>
    	<input type="text" name="username" placeholder="username">
      </div>
      <div class="form-group">
    	<label>密码</label>
    	<input type="password" name="password" placeholder="password">
      </div>
      <div class="form-group">
    	<input class="btn btn-default" type="submit" name="submit" value="登录">
      </div>
      <a href="resetpassword.php">Forgot your password?</a>
    </form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 <?php	  
  }
 ?>


 <?php
  function do_html_footer(){  //显示页脚html
?>
 </body>
</html>
 <?php	  
  }
 ?>


  <?php
  function display_register_form(){  //显示注册表单html
?>
    <form action="register_new.php" method="post">
    	用户名：<input type="text" name="username">
    	密码：<input type="password" name="password1">
    	重复密码：<input type="password" name="password2">
    	邮箱：<input type="text" name="email">
    	<input type="submit" name="submit" value="注册">
    </form>
 <?php	  
  }
 ?>

<?php
  function display_forgot_password_form(){  //显示忘记密码表单html
?>
    <form action="resetpassword.php" method="post">
      用户名：<input type="text" name="username">
      <input type="submit" name="submit" value="重置密码">
    </form>
 <?php    
  }
 ?>


<?php
   function dispaly_recommend_bm($username){
    $db = db_connect();
    $query = "select bm_URL from bookmark where username in(
                                               select distinct(b2.username)
                                               from bookmark b1, bookmark b2
                                               where b1.username='".$username."' 
                                               and b1.username != b2.username
                                               and b1.bm_URL = b2.bm_URL)
                                          and bm_URL not in(
                                               select bm_URL from bookmark
                                               where username='".$username."')
                                          group by bm_URL";
    $result = $db->query($query);
    if($result->num_rows > 0){
      echo "<table>";
      //用这种for循环很巧妙
      for ($i=0; $row = $result->fetch_row(); $i++) { 
        echo "<tr><td>$row[0]</td></tr>";
      }
      //平时都用下面的for循环取值
      // for ($i=0; $i < $result->num_rows; $i++) { 
      //   $row = $result->fetch_row();
      //   echo "<tr><td>$row[0]</td></tr>";
      }
    }
?>

   </table>

<?php
   }
?>



 <?php
    
   function db_connect(){
   	@$db = new mysqli('localhost','root','','bookmarks');
   	if ($db->connect_errno) {
   		echo "Can't connect database.";
   		exit();
   	}
   	$db->query("set names utf8");
   	return $db;
   }



   function filled_out($form_vars){ //验证注册表单是否填写完整
   	foreach ($form_vars as $key => $value) {
   		if (!isset($key) || $value == '') {
   			return flase;   			
   		}
   		return true;
   	}

   }

   function vaild_email($email){
   	if (preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email)) {
   		return true;
   	}else{
   		return flase;
   	}
   }





   function register($username, $email, $password1){
   	//这里不能引用conn.php，再调用$db->query(),会提示错误
   	@$db = new mysqli('localhost','root','','bookmarks');
    if (mysqli_connect_errno()) {
   	  echo "Can't connected database.";
    }
	   $db->query("set names 'utf8'");
	   $query = "insert into user values('".$username."','".$password1."','".$email."')";
	   //$query = "insert into user values('$username','$password1','$email')";
	   $result = $db->query($query);
   	if ($result) {
   		echo $db->affected_rows."data inserted.";
   	}else{
   		echo "insert data failure.";
   	}
   	$db->close();
   }


   function del_bm($del_url){
       $db = db_connect();
    foreach ($del_url as $value) {       
       $query = "delete from bookmark where bm_URL = '".$value."'";
       $result = $db->query($query);
       echo "已删除：".$value."<br />";
    }
    if ($db->affected_rows) {
      echo "删除成功";
      do_html_url('member.php','返回标签列表页');
    }else{
      echo "删除失败";
    }
   }



   function reset_password(){
      if ($_POST['submit']) {
    $username = $_POST['username'];
    for ($i=0; $i < 6 ; $i++) { 
      $new_password .= mt_rand(0,9);
    }
    if (!$username) {
      do_html_url('resetpassword.php','填写用户名');
      exit();
    }
    $db = db_connect();
    $query = "update user set passwd='".$new_password."' where username='".$username."'";
    $result = $db->query($query);
    if ($db->affected_rows > 0) {
      do_html_url('login.php','密码已修改为'.$new_password);
    }else{
      echo "密码修改失败";
    }
  }
   }



   function do_html_url($url,$tittle){
   	echo "<script language=javascript>alert('".$tittle."');location.href='".$url."';</script>";

   }

   function check_valid_user(){
   	if (isset($_SESSION['valid_user'])) {
   		echo "欢迎您，".$_SESSION['valid_user']."<br>";
   	}else{
   		do_html_header("Problem:");
   		do_html_url('login.php','您还没有登录，请先登录');
   		do_html_footer();
   		exit();
   	}
   }

  
   function check_password($username,$old_password){
    $db = db_connect();
    $query = "select username,passwd from user where username='".$username."' and passwd='".$old_password."'";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
      return true;
    }else{
      return false;
    }
    $db->close();
   }



   function change_new_password($username,$password1){
    $db = db_connect();
    $query = "update user set passwd='".$password1."' where username='".$username."'";
    $result = $db->query($query);
    if ($db->affected_rows > 0) {
      return true;
    }else{
      return false;
    }
    // print_r($db->affected_rows);
    // //现在的问题是query语句是错的，按理$db->affected_rows是0，但在上面运行后是true，搞清楚是为什么
    // //其实如果语句错了$db->affected_rows是-1，而非0都是true，所以程序就按true运行
    // //如果查询语句正确但没有找到对应的数据进行更新$db->affected_rows是0
    // //所以看update是否成功用$db->affected_rows>0最合理
    // echo "<br>";
    // var_dump($result);
    // //$result返回的是bool值，sql语句执行了返回true，执行错误返回false
    // //但有没有正在成功插入数据他并不知道，成功或失败都返回true
    // echo "<br>";
    // print_r($result);

   }
    



   function get_user_urls($user){
   	// @$db = new mysqli('localhost','root','','bookmarks');
    // if ($db->connect_errno) {
   	//   echo "Can't connected database.";
   	//   exit();
    // }
	   // $db->query("set names 'utf8'");
   	$db = db_connect(); //上面代码用连接数据库函数代替了
   	$query = "select bm_URL from bookmark where username = '".$user."'";
   	$result = $db->query($query);
   	$num_result = $result->num_rows;
   	$url_array = array();

   	for ($i=0; $i < $num_result ; $i++) { 
   		$row = $result->fetch_assoc();
   		$url_array[$i] = $row['bm_URL'];  //每次bm_URL的结果赋值给新的数组$url_array 		
   	}
   	return $url_array;
   }
 ?>


 <?php
   ////卡在数组用什么方法正确打印出来
   
   function display_user_urls($url_array){
    global $bm_table;
   $bm_table = true;
 ?>
   <form action="delbm.php" method="post" name="bm_table">
   	 <table>
   	 	<?php
   	 	    echo "以下是您的书签：<br>";
          foreach ($url_array as $value) {
          	echo "
          	      <tr>
          	        <td>书签：</td>
          	        <td><a href=".$value." target=\"_blank\">".htmlspecialchars($value)."</a></td>
          	        <td><input type='checkbox' name=\"del_me[]\" value=".$value."></input></td>
          	      </tr>";
          }
   	 	?>
   	 </table>
   </form>
<?php
   }
?>

 <?php
    function display_user_menu(){
 ?>

   <ul class="list-inline">
   	<li><a href="member.php">HOME</a> | </li>
   	<li><a href="addbm.php">Add BM</a> | </li>
 <?php
    global $bm_table;
    if ($bm_table == true) {
    	echo "<li><a href='#' onClick='bm_table.submit();'>Delete BM</a> | </li>";
    }else{
    	echo "<li><span style='#cccccc'>Delete BM</span> | </li>";
    }
  ?>
   	<li><a href="changepw.php">Change password</a> | </li>
   	<li><a href="recommend.php">Recommend URLs to me</a> | </li>
   	<li><a href="logout.php">Logout</a> | </li>
   </ul>
 <?php
      }
 ?>


 <?php
    function display_changepassword_form(){
 ?>
   <form action="changepw.php" method="post" name="changepw">
     <tr>
       <td>原始密码：</td>
       <td><input type="password" name="old_password"></td>
       <td>新密码：</td>
       <td><input type="password" name="new_password1"></td>
       <td>新密码：</td>
       <td><input type="password" name="new_password2"></td>
       <td><input type="submit" name="submit" value="确认修改"></td>
     </tr>
   </form>
<?php
   }
?>