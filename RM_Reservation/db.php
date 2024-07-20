<?php 
    $host = 'localhost';
    $dbname= 'rm_reservation';
    $admin = 'root';
    $mdp = '';
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $admin, $mdp);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("CONNEXION ECHOUEE : ".$e->getMessage());
    }