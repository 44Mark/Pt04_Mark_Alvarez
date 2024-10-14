<?php

require('../Model/usuari.php');

// Funció per verificar si te tot lo necessari oer anar a model i fer l'insert
function signup($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        $_SESSION['message'] = "Els camps no poden estar buits.";
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        $_SESSION['message'] = "Els camps contrasenya no son igual.";
    } else if (correuExisteix($correu)) {
        $_SESSION['message'] = "El correu ja existeix.";
    } else {
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
        afegirUsuari($nom, $correu, $contrasenya_hashed);
        $_SESSION['message'] = "Usuari registrat correctament.";
    }
}

function login($correu, $contrasenya) {
    if (!correuExisteix($correu)) {
        $_SESSION['message'] = "El correu no existeix.";
    } else if (empty($correu)) {
        $_SESSION['message'] = "El camp correu esta buit.";  
    } else if (empty($contrasenya)) {
        $_SESSION['message'] = "El camp contraseya esta buit.";
    } else{
        $usuari = obtenirUsuari($correu);
    }
    
    if (!password_verify($contrasenya, $usuari['contrasenya'])) {
        $_SESSION['message'] = "Contrasenya incorrecta.";
    } else {
        iniciarSessio($correu, $contrasenya);
        $_SESSION['message'] = "Sessió iniciada correctament.";
        
        $_SESSION['correu'] = $correu;
        $_SESSION['nom'] = $usuari['nom'];

        header('Location: ../index.php');
    }
}
?>