<?php
session_start();

include('../Model/llibres.php');

if (empty($_GET['id'])) {
    $_SESSION['message'] = 'No hi ha cap llibre per eliminar';
} else {
    eliminarLlibre($_GET['id']);
    $_SESSION['message'] = 'Llibre eliminat correctament';
    header('Location: ../index.php');
    exit();
}
?>