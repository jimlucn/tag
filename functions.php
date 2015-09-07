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
    <form class="form-inline">
      <div class="form-group">
    	<label>用户名</label>
    	<input type="text" name="username" placeholder="username">
      </div>
      <div class="form-group">
    	<label>密码</label>
    	<input type="password" name="password" placeholder="password">
      </div>
      <div class="form-group">
    	<input class="btn btn-default" type="button" name="submit" value="登录">
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
    	<input type="button" name="submit" value="注册">
    </form>
 <?php	  
  }
 ?>

 <?php
   function filled_out($form_vars){

   }

   function vaild_email($email){

   }

   function register($username, $email, $password1){

   }
 ?>