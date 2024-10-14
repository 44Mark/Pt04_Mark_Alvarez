<?php
include __DIR__ . '/../Model/connexio.php';

// Funció per fer un select de tots els articles al menu per a qualsevol usuari
function obtenirArticles() {
    global $connexio;
    $stmt = $connexio->prepare("SELECT * FROM taula_articles");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per fer un select del articles que ha creat l'usuari pel seu correu
function obtenirArticlesUsuari($correuUsuari) {
    global $connexio;

    // Obtener los artículos del usuario usando su correo
    $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE correu_usuari = :correuUsuari");
    $stmt->bindParam(':correuUsuari', $correuUsuari);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per fer un insert de llibres per l'id de l'usuari
function insertLlibre($isbn, $titol, $cos, $correuUsuari) {
    global $connexio;

    // Insertar el artículo en la base de datos
    $stmt = $connexio->prepare("INSERT INTO taula_articles (isbn, titol, cos, correu_usuari) VALUES (:isbn, :titol, :cos, :correuUsuari)");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':titol', $titol);
    $stmt->bindParam(':cos', $cos);
    $stmt->bindParam(':correuUsuari', $correuUsuari);
    $stmt->execute();
}

// Funció per eliminar el llibre 
function eliminarLlibre($isbn) {
    global $connexio;

    // Eliminar el llibre de la base de dades
    $stmt = $connexio->prepare("DELETE FROM taula_articles WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();
}
?>