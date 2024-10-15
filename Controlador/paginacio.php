<?php
if (isset($_SESSION['correu'])) {
    $articles = obtenirArticlesUsuari($_SESSION['correu']);
} else {
    $articles = obtenirArticles();
}

// 5 articles per pagina
$articlesPerPage = 7;

// Pàgina per defecte la 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el offset (Operació per saber a aprtir de quin article mostrar)
$offset = ($page - 1) * $articlesPerPage;

// Obtenir el total d'articles
$totalArticles = count($articles); // Suponiendo que $articles contiene todos los artículos

// Obtenir els articles a mostrar
$articlesToShow = array_slice($articles, $offset, $articlesPerPage);

// Calcular el número total de páginas
$totalPages = ceil($totalArticles / $articlesPerPage);
?>