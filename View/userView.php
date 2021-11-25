<?php

class UserView
{

    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showSetUsers($users)
    {
        $this->smarty->assign("users", $users);
        $this->smarty->display('templates/adminUser.tpl');
    }

    function showAdminUserLocation()
    {
        header("Location: " . BASE_URL . "users");
    }
}