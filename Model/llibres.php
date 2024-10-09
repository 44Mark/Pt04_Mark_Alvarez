<?php
include('./Model/connexio.php');

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