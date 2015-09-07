<?php
  @$db = new mysqli('localhost','root','','bookmarks');
  if (mysqli_connect_errno()) {
  	echo "Can't connect database.";
  }
  $db->query("set names 'utf8'");
?>