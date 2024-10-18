<?php
session_start();

require('../Model/usuari.php');

// Funció per verificar si te tot lo necessari per  fer l'insert
function signup($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
    // Comprovem si els camps estan buits
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        $_SESSION['message'] = "Els camps no poden estar buits.";
        return;
    // Comprovem que la contrasenya tingui minim 8 caracters amb majuscules, minuscules, numeros i simbols
    } else if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/', $contrasenya)) {
        $_SESSION['message'] = "La contrasenya ha de tenir entre 8 i 16 caracters, una majuscula, una minuscula, un numero i un simbol.";
        return;
    // Comprovem si les contrasenyes son iguals
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        $_SESSION['message'] = "Els camps contrasenya no son igual.";
        return;
    // Comprovem si el correu ja existeix
    } else if (correuExisteix($correu)) {
        $_SESSION['message'] = "El correu ja existeix.";
        return;
    // Si tot esta correcte, fem el hash de la contrasenya i cridem a afegirUsari per fer l'insert
    } else {
        $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
        afegirUsuari($nom, $correu, $contrasenya_hashed);
        $_SESSION['message'] = "Usuari registrat correctament.";
    }
}

// Funció per verificar si te tot lo necessari per fer el login
function login($correu, $contrasenya, $recordar) {
    // Comprovem si els camp correu esta buit
    if (empty($correu)) {
        $_SESSION['message'] = "El camp correu esta buit.";
        return;
        // Comprovem si els camp contraseya esta buit
    }else if (empty($contrasenya)) {
        $_SESSION['message'] = "El camp contraseya esta buit.";
        return;
    // Comprovem si el correu existeix
    }else if (!correuExisteix($correu)) {
        $_SESSION['message'] = "El correu no existeix.";
        return;
    }

    // Si tot esta correcte, cridem a obtenirUsuari per obtenir el correu de l'usuari
    $usuari = obtenirUsuari($correu);
    
    // Comprovem si la contrasenya es correcta
    if (!password_verify($contrasenya, $usuari['contrasenya'])) {
        $_SESSION['message'] = "Contrasenya incorrecta.";
        return;
    }

    if ($recordar) {
        setcookie('correu', $correu, time() + (86400 * 30), "/");
        setcookie('contrasenya', $contrasenya, time() + (86400 * 30), "/");
    }
    

    $_SESSION['message'] = "Sessió iniciada correctament.";
    // Guardem el correu i el nom de l'usuari a la session per poder modificar els botons  de index.php(benvinguda) i header.php(navbar)
    $_SESSION['correu'] = $usuari['correu'];
    $_SESSION['nom'] = $usuari['nom'];
    $_SESSION['timeout'] = time();

    header('Location: ../index.php');
}
?>