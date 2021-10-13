<?php
require_once './Model/carsModel.php';
require_once './View/carsView.php';
require_once './helpers/authHelper.php';


class CarsController{

    private $model;
    private $view;
    private $authHelper;
    function __construct()
    {
        $this->model = new CarsModel;
        $this->view = new CarsView;
        $this->authHelper = new AuthHelper();
    }

    function home(){
        $this->authHelper->checkLoggedIn();
        $allBrands = $this->model->getBrands();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, null);
    }

    function showAllCars(){
        $this->authHelper->checkLoggedIn();
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars);
    }

    function byBrand($brand){
        $this->authHelper->checkLoggedIn();
        $carsBrand = $this->model->getCarsBrand($brand);
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle);
    }

    function descriptionByCar($carDescription){
        $this->authHelper->checkLoggedIn();
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
        $id = $this->model->getIdCarImg($_POST['car']);

        $allBrands = $this->model->getBrands();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, $id);
    }

    function saveImgCar(){
        if(isset($_FILES['photo'])){

            //retenemos toda la informacion
            $typeFile = $_FILES['photo']['type'];
            $nameFile = $_FILES['photo']['name'];
            $sizeFile = $_FILES['photo']['size'];
            $car = $_POST['car'];
            $id = $_POST['id'];

            //extraemos los binarios de la img
            $uploadedImg = fopen($_FILES['photo']['tmp_name'], 'r');
            $biImg = fread($uploadedImg, $sizeFile);

            $this->model->saveImgCarDB($car, $nameFile, $biImg, $typeFile, $id);
            $this->view->viewHomeLocation(); 
        } 
    }

    // function createCar(){  
    //     if(!isset($_POST['sold'])){
    //         $sold = 0;    
    //     }else{
    //         $sold = 1;
    //     } 
    //     $this->model->createCarDB($_POST['car'], $_POST['brand'], $_POST['year'], $_POST['description'], $_POST['euro'], $sold);    
        
    //     $id = $this->model->getIdCarImg($_POST['car']);
        
    //     var_dump($_FILES['photo']);

        
    //     if(isset($_FILES['photo'])){
    //         //retenemos toda la informacion
    //         $typeFile = $_FILES['photo']['type'];
    //         $nameFile = $_FILES['photo']['name'];
    //         $sizeFile = $_FILES['photo']['size'];
            
    //         //extraemos los binarios de la img
    //         $uploadedImg = fopen($_FILES['photo']['tmp_name'], 'r');
    //         $biImg = fread($uploadedImg, $sizeFile);

            
    //         $this->model->saveLogoDB($_POST['car'], $nameFile, $biImg, $typeFile, $id);
    //         $this->view->viewHomeLocation();
    //     }
    // }


    function saveLogo(){
        if(isset($_FILES['photo'])){
            //retenemos toda la informacion
            $typeFile = $_FILES['photo']['type'];
            $nameFile = $_FILES['photo']['name'];
            $sizeFile = $_FILES['photo']['size'];
            $brand = $_POST['brand'];
            //extraemos los binarios de la img
            $uploadedImg = fopen($_FILES['photo']['tmp_name'], 'r');
            $biImg = fread($uploadedImg, $sizeFile);

            
            $this->model->saveLogoDB($brand, $nameFile, $biImg, $typeFile);
            $this->view->viewHomeLocation();
        }
    }

    function createBrand(){ 
        if(isset($_POST['brand'], $_POST['descriptionBrand'])){
            $brand = $_POST['brand'];
            $description = $_POST['descriptionBrand'];
            $idLogo = $_POST['idlogo'];
        }
        $this->model->createBrandDB($brand, $description, $idLogo);    
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
