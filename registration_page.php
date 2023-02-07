<?php
require "jsondb_logic.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

  $login = "";
  $login_error = "";
  $login_unique = "";


  $password = "";
  $password_error = "";

  $password_conf = "";
  $passwordconf_error = "";

  $email = "";
  $email_error = "";
  $email_unique = "";

  $name = "";
  $name_error = "";

  $jdb_handle = new Work_jdb();


  if (isset ($_POST["login"]) && $_POST["login"]){
    $login = $_POST["login"];
    $login_unique = $jdb_handle->check_unique('login', $login);
    
    $pattern_login = '/(?!.*[\W])(?!.*[\s])(?!.*[_])(?=.*[a-zA-Z0-9]){6,}/';

    if (preg_match($pattern_login, $login)==false) {
      $login_error = '<font color="red">Логин может состоять не менее чем из 6 символов(лат. буквы или цифры)</font>';
    }
  }


  if (isset ($_POST["email"]) && $_POST["email"]){
    $email = $_POST["email"];
    $email_unique = $jdb_handle->check_unique('email', $email);
    $pattern_email = '/^[a-z0-9-_\.]+@[a-z0-9-\.]+\.\S{2,8}$/';
    if (preg_match($pattern_email, $email)==false) {
      $email_error = '<font color="red">Неверно веден E-mail</font>';
    }
    
  }

  if (isset ($_POST["password"]) && $_POST["password"]){
    $password = $_POST["password"];

    $lat_let = preg_match('@[A-Za-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $lower_underline_Char = preg_match('@[_]@', $password);

    $password_error = '';

    if ($lat_let && $number && $specialChars==0 && $lower_underline_Char==0 && strlen($password) >= 6){
        $password_error= '';

    } else {
        
        if ($lat_let==0) {
            if (strlen($password_error)==0) {
                $password_error = 'Пароль должен содержать латинские буквы';
            } else {
                $password_error .= ', должен содержать латинские буквы';
            }
            
        }
        if ($number==0) {
            if (strlen($password_error)==0) {
                $password_error = 'Пароль должен содержать цифры';
            } else {
                $password_error .= ', должен содержать цифры';
            }
            
        }
        if ($specialChars) {
            if (strlen($password_error)==0) {
                $password_error = 'Пароль не должен содержать специальные символы';
            } else {
                $password_error .= ', не должен содержать специальные символы';
            }
            
        }
        if ($lower_underline_Char) {
            if (strlen($password_error)==0) {
                $password_error = 'Пароль не должен содержать нижнее подчеркивание';
            } else {
                $password_error .= ', не должен содержать нижнее подчеркивание';
            }
            
        }
        if (strlen($password)<6) {
            if (strlen($password_error)==0) {
                $password_error = 'Пароль должен быть не короче 6 символов';
            } else {
                $password_error .= ', должен быть не короче 6 символов';
            }
            
        }
        $password_error = '<font color="red">'.$password_error.'</font>';
    }
  }

  if (isset ($_POST["password_conf"]) && $_POST["password_conf"]){
    $password_conf = $_POST["password_conf"];
    if ($password===$password_conf) {
      $passwordconf_error ='';
    } else {
       $passwordconf_error ='<font color="red">Введите пароль повторно</font>';
    }
  }


  if (isset ($_POST["name"]) && $_POST["name"]){
    $name = $_POST["name"];
    $pattern_name = '/[a-zA-Z]{2,}/';
    if (preg_match($pattern_name, $name)==false) {
      $name_error = '<font color="red">Имя должно быть не короче 2 символов и состоять из латинских букв</font>';
    }
  }

  if ($login_error=="" && $login_unique && $email_unique && $email_error=="" && $password_error=="" && $passwordconf_error=="" && $name_error=="") {
    $add_result = $jdb_handle ->add_line($login, $password, $email, $name);
    echo json_encode(array('success' =>1 , 'result'=>$add_result)); 
  } else {
    if ($login_unique==false) {
      $login_error.= '<font color="red">Пользователь с таким логином уже зарегистрирован</font>';
    }
    if ($email_unique==false) {
      $email_error.= '<font color="red">Пользователь с таким E-mail уже зарегистрирован</font>';
    }
    echo json_encode(array('success' =>0 , 'login_error'=>$login_error, 'password_error'=>$password_error, 'passwordconf_error'=>$passwordconf_error, 'email_error'=>$email_error, 'name_error'=>$name_error, 'login_unique'=> $login_unique, 'email_unique'=>$email_unique)); 
  }
}

?>