<?php
require_once ("./model/userModel.php");
require_once("./view/loginView.php");

class LoginController{

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

    // function verifyLogin(){
    //     if(!empty($_POST['email']) && !empty($_POST['password'])){
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];

    //         //obtenemos el usuario de la base de datos
    //         $user = $this->model->getUser($email);
            
    //         //si el usuario existe y las contraseñas coinciden
    //         if($user && password_verify($password, $user->password)){

    //             session_start();
    //             $_SESSION['email'] = $email;

    //             $this->view->showHome();
    //         }else{
    //             $this->view->showLogin("Acceso denegado");
    //         }
    //     }
    // }
}