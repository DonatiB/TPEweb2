<?php
require_once './Model/brandModel.php';
require_once './View/brandView.php';
require_once './helpers/authHelper.php';


class BrandController{

    private $model;
    private $view;
    private $authHelper;
    function __construct()
    {
        $this->model = new BrandModel;
        $this->view = new BrandView;
        $this->authHelper = new AuthHelper();
    }

    function home(){
        $this->authHelper->checkLoggedIn();
        $allBrands = $this->model->getBrands();
        $allBrandsAndCar = $this->model->getBrandsAndCar();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, $allBrandsAndCar, null);
    }

    //siempre va a ser true (queria intentarlo con otra tabla que tuviera los roless)
    function log(){  
        $log = true; 
        return $log;
    }

    function homeVisit(){
        $log = $this->log();
        $allBrands = $this->model->getBrands();
        $allBrandsAndCar = $this->model->getBrandsAndCar();
        $brandsLogo= $this->model->getBrandsLogo();
        $allCars = $this->model->getAllCars();
        $this->view->viewHome($allBrands, $brandsLogo, $allCars, $allBrandsAndCar,$log);
    }

    
    function createBrand(){

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
            
            $idLogoArray = $this->model->getIdBrandImg($_POST['brand']);
            foreach($idLogoArray as $item){
                $idLogo = $item->id_logo;
            }

            if(isset($_POST['brand'], $_POST['descriptionBrand'])){
                $brand = $_POST['brand'];
                $description = $_POST['descriptionBrand'];

                $this->model->createBrandDB($brand, $description, $idLogo);
                $this->view->viewHomeLocation();
            }
        }
    }

    function deleteBrand($brand, $car){
        $this->model->deleteBrandDB($brand, $car);    
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