<?php

class CommentModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=carsjaponeses;charset=utf8', 'root', '');
    }

    // TRAE LA TABLA DE COMENTARIOS
    function getCommentsFromDB()
    {
        $sentencia = $this->db->prepare("SELECT * FROM comments");
        $sentencia->execute();
        $comments = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    // TRAE LAS DOS TABLAS: COMENTARIOS Y USUARIOS
    function getCommentsAndUsersFromDB()
    {
        $sentencia = $this->db->prepare("SELECT * FROM comments INNER JOIN users ON comments.fk_user = users.id_user");
        $sentencia->execute();
        $comments = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function getCommentsCarsFromDB($id)
    {
        $sentencia = $this->db->prepare("SELECT id_comment, comment, fk_car, fk_user, score, email, admin, id_user FROM comments, users WHERE comments.fk_user = users.id_user AND comments.fk_car=?");
        $sentencia->execute(array($id));
        $comments = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    // TRAE UN COMENTARIO EN PARTICULAR POR ID
    function getCommentFromDB($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM comments WHERE id_comment = ?");
        $sentencia->execute(array($id));
        $comment = $sentencia->fetch(PDO::FETCH_OBJ);
        return $comment;
    }


    //ELIMINA COMENTARIO POR ID
    function deleteCommentFromDB($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM comments WHERE id_comment = ?");
        $sentencia->execute(array($id));
    }

    function addCommentFromDB($comment, $user, $car, $score)
    {
        $sentencia = $this->db->prepare("INSERT INTO comments (comment, fk_user, fk_car, score) VALUES(?,?,?,?)");
        $sentencia->execute(array($comment, $user, $car, $score));
        return $this->db->lastInsertId();
    }

    
}