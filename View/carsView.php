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

    function viewHome($allBrands, $brandsLogo, $allCars, $id){     
        foreach($allBrands as $images){
            $images->image = base64_encode($images->image);
        }        
        $this->smarty->assign('allBrands', $allBrands);    
        $this->smarty->assign('brandsLogo', $brandsLogo);
        $this->smarty->assign('allCars', $allCars);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/home.tpl'); 
    }

    // function viewId($id){            
    //     $this->smarty->display('templates/home.tpl'); 
    // }

    function viewAllCars($allCars){             
        $this->smarty->assign('allCars', $allCars);    
        $this->smarty->display('templates/allCars.tpl'); 
    }

    function carsByBrand($carsBrand, $brandTitle, $carsImg){
        foreach($carsImg as $images){
            $images->image = base64_encode($images->image);
        }  
        $this->smarty->assign('title', $brandTitle);
        $this->smarty->assign('carsBrand', $carsBrand);
        $this->smarty->assign('carsImg', $carsImg);
        $this->smarty->display('templates/carsBrand.tpl');
    }

    function viewDescription($carDescription){
        $this->smarty->assign('carDescription', $carDescription);
        $this->smarty->display('templates/carDescription.tpl');
    }
    

}