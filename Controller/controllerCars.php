<?php
require_once 'Model/modelCars.php';
require_once 'View/viewCars.php';


class ControllerCars{

    private $model;
    private $view;
    function __construct()
    {
        $this->model = new ModelCars;
        $this->view = new ViewCars;
    }

    function home(){
        $allBrands = $this->model->getBrands();
        $this->view->viewHome($allBrands);
    }

    function showAllCars(){
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars);
    }

    function byBrand($brand){
        $carsBrand = $this->model->getCarsBrand($brand);
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle);
    }

    function descriptionByCar($carDescription){
        $carDescription = $this->model->descriptionByCarDB($carDescription);
        $this->view->viewDescription($carDescription);
    }

    function deleteCar($brand, $id){
        $this->model->deleteCarDB($id);
        $this->view->viewBrandLocation($brand);
    }

    function soldCar($brand, $sold){
        $this->model->soldCarDB($sold);
        $this->view->viewBrandLocation($brand);        
    }

    function onSaleCar($brand, $sold){
        $this->model->onSaleCarDB($sold);
        $this->view->viewBrandLocation($brand);
    }

    function createCar(){       
        if(!isset($_POST['sold'])){
            $sold = 0;    
        }else{
            $sold = 1;
        } 
        $this->model->createCarDB($_POST['car'], $_POST['brand'], $_POST['year'], $_POST['description'], $_POST['euro'], $sold);    
        $this->view->viewHomeLocation();

    }

    function createBrand(){
        if(isset($_POST['brand'], $_POST['descriptionBrand'])){
            $brand = $_POST['brand'];
            $description = $_POST['descriptionBrand'];
        } 
        $this->model->createBrandDB($brand, $description);    
        $this->view->viewHomeLocation();
    }

    function deleteBrand($brand){
        $this->model->deleteBrandDB($brand);    
        $this->view->viewHomeLocation();
    }

    function modifiedName(){ 
        if(!empty($_POST['newName'] && $_POST['nameModified']) && isset($_POST['newName'], $_POST['nameModified'])){       
            $newName = $_POST['newName'];
            $nameModified = $_POST['nameModified'];    
        }
        $this->model->modifiedNameDB($newName, $nameModified);
        $this->view->viewHomeLocation();
    }
}
