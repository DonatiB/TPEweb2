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

    function getAllCars(){
        $query = $this->db->prepare(
            'SELECT * 
            FROM cars c 
            INNER JOIN imgcars i
            ON c.id = i.id');
        $query->execute();
        $allCars = $query->fetchAll(PDO::FETCH_OBJ);
        return $allCars;
    }

    function getCarsBrand($brand){
        $query = $this->db->prepare(
            'SELECT b.brand, c.description, c.car, c.sold, c.id, c.year 
            FROM cars c 
            INNER JOIN brands b
            ON c.id_brand = b.id_brand
            WHERE b.brand =?');
        $query->execute(array($brand));
        $carsBrand = $query->fetchAll(PDO::FETCH_OBJ);
        return $carsBrand;
    }

    function getImgCars(){
        $query = $this->db->prepare(
            'SELECT * 
            FROM cars c 
            INNER JOIN imgcars i
            ON c.id = i.id');
        $query->execute();
        $carsImg = $query->fetchAll(PDO::FETCH_OBJ);
        return $carsImg;
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

    function deleteCarDB($id, $car){
        $queryCar = $this->db->prepare("DELETE FROM imgcars WHERE carImg=?");
        $queryCar->execute(array( $car));
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

    function getIdCarImg($car){     
        $query = $this->db->prepare('SELECT id FROM cars WHERE car=?');
        $query->execute(array($car));
        $carId = $query->fetchAll(PDO::FETCH_OBJ);
        return $carId;
    }

    function saveImgCarDB($car, $name, $biImg, $type, $id){
        $query = $this->db->prepare('INSERT INTO imgcars(carImg, name, image, type, id) VALUES (?, ?, ?, ?, ?)');
        $query->execute(array($car, $name, $biImg, $type, $id));
    }
}