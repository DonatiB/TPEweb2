<?php
require_once "./Model/commentModel.php";
require_once "./View/apiView.php";


class ApiCommentController{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new CommentModel();
        $this->view = new ApiView(); 
    
    }

    function getComments()
    {
        $comments = $this->model->getCommentsFromDB();
    
        if($comments)
        {
            return $this->view->response($comments, 200);
        }else{
            return $this->view->response("No hay comentarios para mostrar.", 204);
        }
    }

    function getCommentsByCars($params = [])
    {
        $idComment = $params[':ID'];
        $comment = $this->model->getCommentsCarsFromDB($idComment);

        if($comment)
        {
            return $this->view->response($comment, 200);
        } else{
            return $this->view->response("No hay comentarios para mostrar.", 204);
        }
    }

    function deleteComment($params = [])
    {
        $idComment = $params[':ID'];
        $comment = $this->model->getCommentFromDB($idComment);

        if($comment)
        {
            $this->model->deleteCommentFromDB($idComment);
            return $this->view->response("El comentario fue eliminado exitosamente.", 200);
        } else{
            return $this->view->response("El comentario que desea eliminar no existe.", 404);
        }
    }

    function insertComment()
    {
        $body = $this->getBody();

        $id = $this->model->addCommentFromDB($body->comment, $body->fk_user, $body->fk_car, $body->score);
        if($id != 0)
        {
            return $this->view->response("El comentario fue insertado con el id=$id", 200);
        } else{
            return $this->view->response("El comentario no pudo ser insertado", 500);
        }
    }

    //devuelve el body del request
    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    } 
    
}