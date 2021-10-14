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
        $allBrandsCar = $this->model->getBrandsAndCar();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, null, $allBrandsCar, null);
    }

    function showAllCars(){
        $this->authHelper->checkLoggedIn();
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars, null);
    }

    function byBrand($brand){
        $this->authHelper->checkLoggedIn();
        $carsBrand = $this->model->getCarsBrand($brand);
        $carsImg = $this->model->getImgCars();
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle, $carsImg, null);
    }

    function descriptionByCar($carDescription){
        $this->authHelper->checkLoggedIn();
        $carDescription = $this->model->descriptionByCarDB($carDescription);
        $carsImg = $this->model->getImgCars();
        $this->view->viewDescription($carDescription, $carsImg, null);
    }

    function log(){  
        $log = true; 
        return $log;
    }

    function byBrandVisit($brand){
        $log = $this->log();
        $carsBrand = $this->model->getCarsBrand($brand);
        $carsImg = $this->model->getImgCars();
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle, $carsImg, $log);
    }

    function showAllCarsVisit(){
        $log = $this->log();
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars, $log);
    }

    function descriptionByCarVisit($carDescription){
        $log = $this->log();
        $carDescription = $this->model->descriptionByCarDB($carDescription);
        $carsImg = $this->model->getImgCars();
        $this->view->viewDescription($carDescription, $carsImg, $log);
    }

    function deleteCar($brand, $id, $car){
        $this->model->deleteCarDB($id, $car);
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

        $idLogo = $this->model->getIdBrandImg($_POST['brand']);
        $allBrands = $this->model->getBrands();
        $allBrandsAndCar = $this->model->getBrandsAndCar();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        //la razon por la que llamo otra vez a la funcion home es para pasarle el $id de la imagen
        //intente con otras formas pero no se me ocurrio nada mas que a traves del viewHome
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, $id, $allBrandsAndCar, $idLogo);
        
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
            // var_dump($_FILES['photo']);
        } 
    }
}
