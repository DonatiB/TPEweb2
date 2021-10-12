<?php

class CarsModel{

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
    // function getBrands(){
    //     $query = $this->db->prepare(
    //         'SELECT * FROM brands GROUP BY brand');
    //     $query->execute();
    //     $allBrands = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $allBrands;
    // }

    function getBrandsLogo(){
        $query = $this->db->prepare(
            'SELECT * FROM imgbrands');
        $query->execute();
        $ford = $query->fetchAll(PDO::FETCH_OBJ);
        return $ford;
    }

    function getAllCars(){
        $query = $this->db->prepare(
            'SELECT * FROM cars');
        $query->execute();
        $allCars = $query->fetchAll(PDO::FETCH_OBJ);
        return $allCars;
    }

    function getCarsBrand($brand){
        $query = $this->db->prepare(
            'SELECT * 
            FROM cars c 
            INNER JOIN brands b
            ON c.id_brand = b.id_brand
            WHERE b.brand =?');
        $query->execute(array($brand));
        $carsBrand = $query->fetchAll(PDO::FETCH_OBJ);
        return $carsBrand;
    }
    
    function getBrandTitle($brand){
        $query = $this->db->prepare('SELECT brand FROM brands WHERE brand =? LIMIT 1');
        $query->execute(array($brand));
        $brandTitle = $query->fetchAll(PDO::FETCH_OBJ);
        return $brandTitle;
    }

    function descriptionByCarDB($carDescription){
        $query = $this->db->prepare(
            'SELECT c.car, c.year, c.description, c.sold, c.price, b.brand
            FROM cars c
            INNER JOIN brands b
            ON c.id_brand = b.id_brand 
            WHERE c.id = ?'
        );
        $query->execute(array($carDescription));
        $carDescription = $query->fetchAll(PDO::FETCH_OBJ);
        return $carDescription;
    }

    function deleteCarDB($id){
        $queryCar = $this->db->prepare("DELETE FROM cars WHERE id=?");
        $queryCar->execute(array($id));
    }

    function soldCarDB($sold){
        $query = $this->db->prepare("UPDATE cars SET sold=0 WHERE id=?");
        $query->execute(array($sold));
    }

    function onSaleCarDB($sold){
        $query = $this->db->prepare("UPDATE cars SET sold=1 WHERE id=?");
        $query->execute(array($sold));
    }
    
    function createCarDB($car, $brand, $year, $description, $euro, $sold){     
        $queryCar = $this->db->prepare('INSERT INTO cars(car, id_brand, year, description, price, sold) VALUES (?, ?, ?,?, ?, ?)');         
        $queryCar->execute(array($car, $brand, $year, $description, $euro ,$sold));
    }

    function createBrandDB($brand, $description, $idLogo){
        $queryCar = $this->db->prepare('INSERT INTO brands(brand, description, id_logo) VALUES (?, ?, ?)');         
        $queryCar->execute(array($brand, $description, $idLogo));
    }

    function modifiedNameDB($newName, $nameModified){
        $query = $this->db->prepare("UPDATE brands SET brand=:newName WHERE brand=:nameModified");  
        $query->bindParam(':newName', $newName);
        $query->bindParam(':nameModified', $nameModified);       
        $query->execute();
    }

    function deleteBrandDB($brand){
        $queryCar = $this->db->prepare("DELETE FROM brands WHERE brand=?");
        $queryCar->execute(array($brand));
    }

    function saveImgCarDB($brand, $name, $biImg, $type){
        $query = $this->db->prepare('INSERT INTO `imgcars`(`car`, `name`, `image`, `type`) VALUE(?, ?, ?, ?)');
        $query->execute(array($brand, $name, $biImg, $type));
    }

    function saveLogoDB($brand, $name, $biImg, $type){
        $query = $this->db->prepare('INSERT INTO `imgbrands`(`brand_logo`, `name`, `image`, `type`) VALUE(?, ?, ?, ?)');
        $query->execute(array($brand, $name, $biImg, $type));
    }

    // function getImgCars(){
    //     $query = $this->db->prepare(
    //         'SELECT * FROM imgcars');
    //     $query->execute();
    //     $img = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $img;
    // }
}