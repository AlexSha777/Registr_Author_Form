
<?php

session_start();

if (strpos($_SERVER['HTTP_COOKIE'], 'username=')){
    require "hello_user.html";

} else {
    require "registration.html";

}
?>