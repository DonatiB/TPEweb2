<?php

require_once "./Model/userModel.php";
require_once "loginController.php";
require_once "./helpers/authHelper.php";
require_once "./View/userView.php";

class UserController
{
    private $model;
    private $login;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->login = new LoginController();
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    // REGISTRAR USUARIO
    function addUser()
    {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $this->model->newUserDB($email, $password);
        
        $this->login->verifyLogin();
    }

    function setUsers()
    {
        $this->authHelper->checkAdmin();
        $users = $this->model->getUsers();
        $this->view->showSetUsers($users);
    }

    function deleteUser($id)
    {
        $this->authHelper->checkAdmin();
        $this->model->deleteUserDB($id);
        $this->view->showAdminUserLocation();
    }

    function updateUser($id)
    {
        $this->authHelper->checkAdmin();
        $user = $this->model->getUserById($id);
        // var_dump($user->admin);
        if($user->admin == 0){
            $admin = 1;
        }else{
            $admin = 0;
        }
        $this->model->updateUserDB($id, $admin);
        $this->view->showAdminUserLocation();
    }


}