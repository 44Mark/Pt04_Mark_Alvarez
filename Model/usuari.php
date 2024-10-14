<?php
session_start();

include(__DIR__ . '/../Model/connexio.php');

// Funció per verificar si el correu ja existeix a la BD
function correuExisteix($correu) {
    global $connexio;
    
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetchColumn() > 0;
}

function obtenirUsuari($correu) {
    global $connexio;
    
    $sql = "SELECT * FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funció per afegir un nou usuari a la base de dades
function afegirUsuari($nom, $correu, $contrasenya_hashed) {
    global $connexio;

    $sql = "INSERT INTO usuaris (nom, correu, contrasenya) VALUES (:nom, :correu, :contrasenya)";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':correu', $correu);
    $stmt->bindParam(':contrasenya', $contrasenya_hashed);
   
    $stmt->execute();
}

// Funció per iniciar sessió
function iniciarSessio($correu, $contrasenya) {
    global $connexio;
    
    $sql = "SELECT nom, contrasenya FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    $usuari = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>