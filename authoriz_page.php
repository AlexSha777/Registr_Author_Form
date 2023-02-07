<?php
require "jsondb_logic.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){


  $login = "";
  $login_error = "";
  $login_unique = "";

  $password = "";
  $password_error = "";

  $jdb_handle = new Work_jdb();

  if (isset ($_POST["login"]) && $_POST["login"]){
    $login = $_POST["login"];
    $login_unique = $jdb_handle->check_unique('login', $login);
    if ($login_unique==true) {
      $login_error = '<font color="red">Пользователь с таким логином не зарегистрирован</font><a id="reg_btn" href="registration.html">Зарегистрироваться</a>';
    }
  }


  if (isset ($_POST["password"]) && $_POST["password"]){
    $password = $_POST["password"];
  }

  $user_name = $jdb_handle->logging($login,$password);

  if ($user_name){
    
    session_start();

    setcookie("username", $user_name);
    echo json_encode(array('success' =>1 , 'user_name'=>$user_name));
  } else {
      if ($login_error!=""){
        echo json_encode(array('success' =>0 , 'user_name'=>false, 'password_error'=> '', 'login_error'=> $login_error));
      } else {
        echo json_encode(array('success' =>0 , 'user_name'=>false, 'password_error'=> '<font color="red">Неверный пароль</font>','login_error'=> $login_error));

      }
  }
} else {
  echo "<p>Запрос выполнен не через ajax</p>";
}


?>