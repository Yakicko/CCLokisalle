<?php
// connexion a la BDD
$pdo = new PDO("mysql:host=localhost;dbname=cclokisalle","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

// Appel du fichier contenant les fonction
require_once("function.inc.php");

// création d'une variable message à afficher en cas de besoin à l'utilisateur
$message = "";

// ouverture de la session
session_start();