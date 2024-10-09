<?php
require('../Model/usuari.php');

// Funció per verificar si te tot lo necessari oer anar a model i fer l'insert
function signup($nom, $correu, $contrasenya, $confirmacio_contrasenya) {
    if (empty($nom) || empty($correu) || empty($contrasenya) || empty($confirmacio_contrasenya)) {
        return "Els camps no poden estar buits.";
    } else if ($contrasenya !== $confirmacio_contrasenya) {
        return "Els camps contrasenya no son igual.";
    } else if (correuExisteix($correu)) {
        return "El correu ja existeix.";
    } else {
        afegirUsuari($nom, $correu, $contrasenya, $confirmacio_contrasenya);
        return "Usuari registrat correctament.";
    }
}

function login($correu, $contrasenya) {
    if (!correuExisteix($correu)) {
        return "El correu no existeix.";
    } else if (empty($contrasenya) || empty($correu)) {
        return "Camps buits.";
    } else {
        iniciarSessio($correu, $contrasenya);
    }
}
?>