<?php

session_start();

include(__DIR__ . '/../Model/connexio.php');

$missatge_error = "";

// Funció per verificar si el correu ja existeix a la BD
function correuExisteix($correu) {
    global $connexio;
    
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetchColumn() > 0;
}

// Funció per afegir un nou usuari a la base de dades
function afegirUsuari($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
        global $connexio;
        // Hashear la contrasenya
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
    
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
    
    if (password_verify($contrasenya, $usuari['contrasenya'])) {
        // Iniciar la sessió del usuari
        session_start();
        $_SESSION['correu'] = $correu;
        $_SESSION['nom'] = $usuari['nom'];
        
        // Redirigir a index.php
        header("Location: ../index.php");
        exit();
    } else {
        $missatge_error = "Contrasenya incorrecta.";
        return false;
    }
}
?>