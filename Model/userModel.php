<?php

class UserModel{

    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carsjaponeses;charset=utf8', 'root', '');
    }

    function newUserDB($userEmail, $userPassword){
        $query = $this->db->prepare('INSERT INTO users(email, password) VALUES (?, ?)');
        $query->execute([$userEmail, $userPassword]);
    }

    function getUser($email){
        $query = $this->db->prepare('SELECT * FROM users WHERE email=?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    function getUserById($id){
        $query = $this->db->prepare('SELECT * FROM users WHERE id_user=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // TRAE TODOS LOS USUARIOS DE LA DB 
    function getUsers()
    {
        $sentencia = $this->db->prepare("SELECT * FROM users");
        $sentencia->execute();
        $users = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }


    function deleteUserDB($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM users WHERE id_user = ?");
        $sentencia->execute(array($id));
    }

    function updateUserDB($id, $admin)
    {
        var_dump($id,$admin);
        $sentencia = $this->db->prepare('UPDATE users SET users.admin=? WHERE id_user=?');
        $sentencia->execute(array($admin, $id));
    }

    
}




