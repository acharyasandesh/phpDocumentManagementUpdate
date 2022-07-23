<?php
    if(empty($SESSION['_token'])){
        $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!ISSET($_POST['_token']) || ($_POST['_token'] !== $_POST['_token'])){
            die('Invalid CSRF token');
        }
    }
?>