<?php

class AuthHelper{

    function __construct()
    {  
    }

    function checkLoggedIn(){
        session_start();
        if(isset($_SESSION['email']) && $_SESSION['admin'] == 0){
            $admin = 0;
        }elseif(isset($_SESSION['email']) && $_SESSION['admin'] == 1){
            $admin = 1;
        }
        else{
            header("Location: ".BASE_URL."login");
        }
        return $admin;
    }

    function checkAdmin()
    {
        session_start();
        if (!isset($_SESSION["email"])||($_SESSION["admin"]==0)) {
            header("Location: " . BASE_URL . "login");
        }
    }

    function user()
    {
        if (isset($_SESSION["id_user"])) {
            $id_user = $_SESSION["id_user"];
        }
        return $id_user;
    }



}