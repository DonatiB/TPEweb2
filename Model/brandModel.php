<?php

class BrandModel{

    private $db;
    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carsjaponese;charset=utf8', 'root', '');
    }

    function getBrands(){
        $query = $this->db->prepare(
            'SELECT b.id_brand, b.brand, b.description, i.id_logo, i.image 
            FROM brands b
            INNER JOIN imgbrands i
            ON b.id_logo = i.id_logo
            GROUP BY b.brand');
        $query->execute();
        $allBrands = $query->fetchAll(PDO::FETCH_OBJ);
        return $allBrands;
    }

    //para eliminar la marca primero hay que eliminar el auto, para eliminar el auto primero hay que eliminar la imagen
    function getBrandsAndCar(){
        $query = $this->db->prepare(
            'SELECT *
            FROM brands b
            INNER JOIN cars c
            ON b.id_brand = c.id_brand
            GROUP BY b.brand');
        $query->execute();
        $allBrands = $query->fetchAll(PDO::FETCH_OBJ);
        return $allBrands;
    }

    function getBrandsLogo(){
        $query = $this->db->prepare(
            'SELECT * FROM imgbrands GROUP BY brand');
        $query->execute();
        $logo = $query->fetchAll(PDO::FETCH_OBJ);
        return $logo;
    }

    

    function getAllCars(){
        $query = $this->db->prepare(
            'SELECT * FROM cars');
        $query->execute();
        $allCars = $query->fetchAll(PDO::FETCH_OBJ);
        return $allCars;
    }

    function createBrandDB($brand, $description, $idLogo){
        $queryCar = $this->db->prepare('INSERT INTO brands(brand, description, id_logo) VALUES (?, ?, ?)');         
        $queryCar->execute(array($brand, $description, $idLogo));
    }

    function getIdBrandImg($brand){     
        $query = $this->db->prepare('SELECT id_logo FROM imgbrands WHERE brand=?');
        $query->execute(array($brand));
        $brandId = $query->fetchAll(PDO::FETCH_OBJ);
        return $brandId;
    }

    function saveLogoDB($brand, $name, $biImg, $type){
        $query = $this->db->prepare('INSERT INTO `imgbrands`(`brand`, `name`, `image`, `type`) VALUE(?, ?, ?, ?)');
        $query->execute(array($brand, $name, $biImg, $type));
    }

    function deleteBrandDB($brand, $car){
        $queryCar = $this->db->prepare("DELETE FROM imgcars WHERE carImg=?");
        $queryCar->execute(array($car));
        $queryCar = $this->db->prepare("DELETE FROM cars WHERE car=?");
        $queryCar->execute(array($car));
        $queryCar = $this->db->prepare("DELETE FROM brands WHERE brand=?");
        $queryCar->execute(array($brand));
        $queryImgBrand = $this->db->prepare("DELETE FROM imgbrands WHERE brand=?");
        $queryImgBrand->execute(array($brand));
    }

    function modifiedNameDB($newName, $nameModified){
        $query = $this->db->prepare("UPDATE brands SET brand=:newName WHERE brand=:nameModified");  
        $query->bindParam(':newName', $newName);
        $query->bindParam(':nameModified', $nameModified);       
        $query->execute();
    }
}