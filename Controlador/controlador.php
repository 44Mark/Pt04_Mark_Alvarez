<?php
session_start();

include(__DIR__ . '/../Model/model.php');

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
    // Comprova si els camps estan buits
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        return "Els camps no poden estar buits.";
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        return "Els camps contrasenya no son igual.";
    } else if (correuExisteix($correu)) {
        return "El correu ja existeix.";
    } else {
        global $connexio;
        
        // Hashear la contrasenya
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO usuaris (nom, correu, contrasenya) VALUES (:nom, :correu, :contrasenya)";
        $stmt = $connexio->prepare($sql);
        
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':correu', $correu);
        $stmt->bindParam(':contrasenya', $contrasenya_hashed);

        if ($stmt->execute()) {
            return "Usuari creat correctament.";
        } else {
            return "Error en la creació de l'usuari.";
        }
    }
}

// Funció per iniciar sessió
function iniciarSessio($correu, $contrasenya) {
    global $connexio, $missatge_error;
    if (!correuExisteix($correu)) {
        $missatge_error = "El correu no existeix.";
        return false;
    } else if (empty($contrasenya) || empty($correu)) {
        $missatge_error = "Camps buits.";
        return false;
    }
    
    $sql = "SELECT nom, contrasenya FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    $usuari = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify($contrasenya, $usuari['contrasenya'])) {
        // Iniciar la sessió del usuari
        $_SESSION['correu'] = $correu;
        $_SESSION['nom'] = $usuari['nom'];
        return true;
    } else {
        $missatge_error = "Contrasenya incorrecta.";
        return false;
    }
}

// Funció per fer un select de tots els articles al menu per a qualsevol usuari
function obtenirArticles() {
    global $connexio;
    $stmt = $connexio->prepare("SELECT * FROM taula_articles");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per fer un select del articles que hac reat l'usuari pel seu correu
function obtenirArticlesUsuari() {
    global $connexio;

    // Obtener el correo de la sesión
    $correuUsuari = $_SESSION['correu'];

    // Obtener los artículos del usuario usando su correo
    $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE correu_usuari = :correuUsuari");
    $stmt->bindParam(':correuUsuari', $correuUsuari);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>