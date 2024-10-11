<?php
require_once('Model/connexio.php'); 
include('Model/llibres.php');
include('Model/usuari.php');

if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
    $articulos = obtenirArticlesUsuari();
} else {
    $_SESSION['usuari_autenticat'] = false;
    $articulos = obtenirArticles();
}

include_once('./Vista/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Artículos</title>
</head>
<body>
    <h1>Descobreix i comparteix els teus llibres preferits</h1>

    <?php if (isset($_SESSION['nom'])): ?> 
        <h2><?php echo 'Benvingut ' . $_SESSION['nom'] . ' aquests son els teus llibres!!'; ?></h2>
    <?php else: ?>
        <h2>Aquests son tots els llibres</h2> 
    <?php endif; ?>
    <div class="container">
        <table class="tablaUsuarios">
            <thead>
                <tr>
                    <th>Titol</th>
                    <th>Contingut</th>
                    <?php if ($_SESSION['usuari_autenticat']): ?>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $art): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($art['titol']); ?></td>
                        <td><?php echo htmlspecialchars($art['cos']); ?></td>
                        <?php if ($_SESSION['usuari_autenticat']): ?>
                            <td><a href="" class="botonindex">Modificar</a></td>
                            <td><a href="" class="botonindex">Eliminar</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>