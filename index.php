<?php
require_once('./Model/connexio.php'); 
include('./Model/llibres.php');
include('./Model/usuari.php');
include('./Controlador/controlPaginacio.php');
include('./Controlador/timeout.php');

// Si la session correu esta definida, significa que l'usuari esta autenticat
if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
    $articles = obtenirArticlesUsuari($_SESSION['correu']);
} else {
    $_SESSION['usuari_autenticat'] = false;
    $articles = obtenirArticles();
}

// Navbar
include_once('./Vista/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Artículos</title>
</head>
<body>
    <h1>Descobreix i comparteix els teus llibres preferits</h1>
    <?php // Si l'usuari esta autenticat, mostrem el seu nom com a benvinguda ?>
    <?php if (isset($_SESSION['nom'])): ?> 
        <h2><?php echo 'Benvingut ' . $_SESSION['nom'] . ' aquests son els teus llibres!!'; ?></h2>
    <?php else: ?>
        <h2>Aquests son tots els llibres</h2> 
    <?php endif; ?>
    <div>
        <table class="tablaUsuarios">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titol</th>
                    <th>Contingut</th>
                    <?php // Si l'usuari esta autenticat, sortiran els botons per modificar i eliminar els articles ?>
                    <?php if ($_SESSION['usuari_autenticat']): ?>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articlesToShow as $art): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($art['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($art['titol']); ?></td>
                        <td><?php echo htmlspecialchars($art['cos']); ?></td>
                        <?php if ($_SESSION['usuari_autenticat']): ?>
                            <?php // Si l'usuari esta autenticat, sortiran els botons per modificar i eliminar els articles ?>
                            <td><a href="Controlador/comprovmodificarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex">Modificar</a></td>
                            <td><a href="Controlador/eliminarllibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">Eliminar</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include_once('./Vista/paginacio.php'); ?>

        <?php // Si hi ha un missatge, el mostrem ?>
        <?php if (isset($_SESSION['message'])) {
            $missatge = $_SESSION['message'];
            echo "<p class='missatge'>$missatge</p>";
            unset($_SESSION['message']); 
        } ?>
    </div>
</body>
</html>