<?php
require_once ("./Model/carsModel.php");
require_once("./View/ApiView.php");


class ApiCarsController{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new CarsModel();
        $this->view = new ApiView(); 
    
    }


    function insertComment($params = null) {
        //obtengo el body del request(json)
        $body = $this->getBody();
        //HACER VALIDACIONES -> 400(bas request)
        $id = $this->model->insertCommentFromDB($body->, $body->, $body->, false);
        //ahora chequeamos que se haya insertado bien 
        if($id =! 0){
            $this->view->response("El comentario se inserto con exito con el id = $id", 200); 
        }else{
            $this->view->response("El comentario no se pudo insertar", 500); 
        }
       
    }

    function deleteComment($params = null) {
        $idComment = $params[":ID"];
        //antes de borrarla tenemos que chequear que esa tarea exista por lo tanto la buscamos en la base de datos y la traemos
        $tarea = $this->model->getTask($idComment);

        if($tarea){
            $this->model->deleteCommentFromDB($idComment);
            return $this->view->response("El comentario con el id $idComment fue borrado", 200);
        }else{
            return $this->view->response("El comentario con el id $idComment no existe", 404);
        }      
    }
   
    //devuelve el body del request
    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}