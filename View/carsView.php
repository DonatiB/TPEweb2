<?php
require_once 'libs/smarty-3.1.39/libs/Smarty.class.php';

class CarsView{

    private $smarty;
    function __construct()
    {
        $this->smarty = new Smarty();
    }
    
    function viewHomeLocation(){
        header("Location: ".BASE_URL."home");
    }

    function viewBrandLocation($brand){
        header("Location: ".BASE_URL_BRAND."/$brand");
    }

    // function showLoginLocation(){
    //     header("Location: ".BASE_URL."login");
    // }

    function viewHome($allBrands){             
        $this->smarty->assign('allBrands', $allBrands);    
        $this->smarty->display('templates/home.tpl'); 
    }

    function viewAllCars($allCars){             
        $this->smarty->assign('allCars', $allCars);    
        $this->smarty->display('templates/allCars.tpl'); 
    }

    function carsByBrand($carsBrand, $brandTitle){
        $this->smarty->assign('title', $brandTitle);
        $this->smarty->assign('carsBrand', $carsBrand);
        $this->smarty->display('templates/carsBrand.tpl');
    }

    function viewDescription($carDescription){
        $this->smarty->assign('carDescription', $carDescription);
        $this->smarty->display('templates/carDescription.tpl');
    }
}