<?php
  session_start();
  $uri = explode("/",$_SERVER['REQUEST_URI']);
  require_once("php/classes/User.php");
  if ($uri[1] == "reg"){
    require_once("reg.php");
  }else if($uri[1]=="auth"){
    require_once("auth.php");
  }else if($uri[1] == "addUser"){
    User::addUser();
  }else if($uri[1] == "authUser"){
    User::authUser();
  }else if($uri[1] == "changeUserData"){
    User::changeUserData();    
  }else{
    echo "Page not found";
  }
?>
