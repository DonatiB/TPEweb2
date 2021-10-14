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

    function getBrandsLogo(){
        $query = $this->db->prepare(
            'SELECT * FROM imgbrands');
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

    function saveLogoDB($brand, $name, $biImg, $type){
        $query = $this->db->prepare('INSERT INTO `imgbrands`(`brand_logo`, `name`, `image`, `type`) VALUE(?, ?, ?, ?)');
        $query->execute(array($brand, $name, $biImg, $type));
    }

    function deleteBrandDB($brand){
        $queryCar = $this->db->prepare("DELETE FROM brands WHERE brand=?");
        $queryCar->execute(array($brand));
    }

    function modifiedNameDB($newName, $nameModified){
        $query = $this->db->prepare("UPDATE brands SET brand=:newName WHERE brand=:nameModified");  
        $query->bindParam(':newName', $newName);
        $query->bindParam(':nameModified', $nameModified);       
        $query->execute();
    }
}