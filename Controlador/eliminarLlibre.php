<?php
session_start();
require('../Model/llibres.php');

// Comprovem si hi ha un id per cridar a la funció eliminarLlibre
if (empty($_GET['id'])) {
    $_SESSION['message'] = 'No hi ha cap llibre per eliminar';
} else {
    eliminarLlibre($_GET['id']);
    
    $_SESSION['message'] = 'Llibre eliminat correctament';

    header('Location: ../index.php');
    exit();
}
?>