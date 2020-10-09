<?php
header('Content-type: text/html; charset=utf-8');
class User{
  static function addUser(){
    $mysqli = mysqli_connect("localhost", "okhater_baza1","%dh5VGVm", "okhater_baza1");
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = mb_strtolower(trim($_POST['email']));
    $pass = trim($_POST['pass']);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    if ($result->num_rows){
      echo "exist";
    }else{
      $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email', '$pass')");
      echo "success";
    }
  }
  static function authUser(){
    $mysqli = new mysqli("localhost", "okhater_baza1","%dh5VGVm", "okhater_baza1");
    $email = mb_strtolower(trim($_POST['email']));
    $pass = trim($_POST['pass']);
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    $row = $result->fetch_assoc();
    if (password_verify($pass,$row['pass'])){
      $_SESSION["name"] = $row["name"];
      $_SESSION["lastname"] = $row["lastname"];
      $_SESSION["email"] = $row["email"];
      $_SESSION["id"] = $row["id"];
      echo "success";
    }else{
      echo "error";
    }
  }
  static function changeUserData(){
    $mysqli = mysqli_connect("localhost", "okhater_baza1","%dh5VGVm", "okhater_baza1");
    $value = $_POST['value'];
    $item = $_POST['item']; //здесь будет лежать либо name либо lastname в завис-ти от того, что выберет польз-ль
    $userId = $_SESSION['id'];
    $mysqli->query("UPDATE `users` SET `$item`='$value' WHERE `id`='$userId'");  //в item кладём то value, кот. надо поместить в БД
    $_SESSION[$item] = $value;
  }
  static function getUsers(){
    /* Пойду в БД и достану список */
  }
  static function getUser($userId){
    /* Пойду в БД и достану пользователя по его ID */
  }
}
?>
