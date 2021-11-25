<?php

use function PHPSTORM_META\type;

require_once  './model/userModel.php';
require_once './view/loginView.php';

class LoginController {

    private $model;
    private $view;
    
    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView(); 
    }

    function login(){
        $this->view->showLogin();
    }

    function logout() {
        session_start();
        session_destroy();
        $this->view->showLogin();
    }

    function registration() { 
        $this->view->showRegistration();
    }

    function newUser() { 
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
        $this->model->newUserDB($userEmail, $userPassword);
        $this->view->showHome();
    }

    function verifyLogin() {
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            //obtenemos el usuario de la base de datos
            $user = $this->model->getUser($email);
            
            if($user){
                $id_user = $user->id_user;
            }

            if($user){
                if($user->admin == 1){
                    $admin = 1;
                }else{
                    $admin = 0;
                }
            }
            
            //si el usuario existe y las contraseñas coinciden
            if($user && password_verify($password, $user->password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['admin'] = $admin;
                $_SESSION['id_user'] = $id_user;

                $this->view->showHome();
            } else {
                $this->view->showLogin("Access Denied");
            }
        }
    }
}