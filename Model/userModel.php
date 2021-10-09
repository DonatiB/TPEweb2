<?php

class UserModel{

    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carsjaponese;charset=utf8', 'root', '');
    }

    function getUser($email){
        $query = $this->db->prepare('SELECT * FROM users WHERE email=?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function newUserDB($userEmail, $userPassword){
        $query = $this->db->prepare('INSERT INTO users(email, password) VALUES (?, ?)');
        $query->execute([$userEmail, $userPassword]);
    }

    
}