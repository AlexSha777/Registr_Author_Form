<?php

$_SESSION = array();
session_name('logged_out');

if (ini_get("session.use_cookies")) {
    setcookie('username', '', 3600);
}

if (isset ($_GET['page']) && $_GET['page'] !=''){
    $page = $_GET['page'];
    if ($page == 'index') {
        require "index.html";
    } else if ($page == 'next_page') {
        require "next_page.php";
    } else {
        require "index.html";
    }
}


?>