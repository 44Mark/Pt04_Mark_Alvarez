<?php

require('../Model/usuari.php');

// Funció per verificar si te tot lo necessari per  fer l'insert
function signup($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
    // Comprovem si els camps estan buits
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        $_SESSION['message'] = "Els camps no poden estar buits.";
    
    // Comprovem si les contrasenyes son iguals
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        $_SESSION['message'] = "Els camps contrasenya no son igual.";
    
    // Comprovem si el correu ja existeix
    } else if (correuExisteix($correu)) {
        $_SESSION['message'] = "El correu ja existeix.";
    
    // Si tot esta correcte, fem el hash de la contrasenya i cridem a afegirUsari per fer l'insert
    } else {
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
        afegirUsuari($nom, $correu, $contrasenya_hashed);
        $_SESSION['message'] = "Usuari registrat correctament.";
    }
}

// Funció per verificar si te tot lo necessari per fer el login
function login($correu, $contrasenya) {
    // Comprovem si el correu existeix
    if (!correuExisteix($correu)) {
        $_SESSION['message'] = "El correu no existeix.";

    // Comprovem si els camp correu esta buit
    } else if (empty($correu)) {
        $_SESSION['message'] = "El camp correu esta buit.";

    // Comprovem si els camp contraseya esta buit
    } else if (empty($contrasenya)) {
        $_SESSION['message'] = "El camp contraseya esta buit.";

    // Si tot esta correcte, cridem a obtenirUsuari per obtenir el correu de l'usuari
    } else{
        $usuari = obtenirUsuari($correu);
    }
    
    // Comprovem si la contrasenya es correcta
    if (!password_verify($contrasenya, $usuari['contrasenya'])) {
        $_SESSION['message'] = "Contrasenya incorrecta.";
    
    // Si tot esta correcte, cridem a iniciarSessio per fer el select
    } else {
        iniciarSessio($correu, $contrasenya);
        $_SESSION['message'] = "Sessió iniciada correctament.";
        
        // Guardem el correu i el nom de l'usuari a la session per poder modificar els botons  de index.php(benvinguda) i header.php(navbar)
        $_SESSION['correu'] = $correu;
        $_SESSION['nom'] = $usuari['nom'];

        header('Location: ../index.php');
    }
}
?>