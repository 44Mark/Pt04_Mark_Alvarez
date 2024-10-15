<?php
require_once('Model/connexio.php'); 
include('Model/llibres.php');
include('Model/usuari.php');
include('Controlador/paginacio.php'); // Incluir paginacio.php antes de usar las variables de paginación

// Si la session correu esta definida, significa que l'usuari esta autenticat
if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
} else {
    $_SESSION['usuari_autenticat'] = false;
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
                            <td><a href="controlador/comprovmodificarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex">Modificar</a></td>
                            <td><a href="controlador/eliminarllibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">Eliminar</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php // Sección de paginación ?>
        <section class="paginacio">
            <ul>
                <!-- Botón "Anterior" -->
                <li class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a href="?page=<?php echo max(1, $page - 1); ?>">&laquo;</a>
                </li>

                <!-- Botones de página -->
                <?php if ($totalPages > 0): ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                <?php else: ?>
                    <li class="active">
                        <a href="?page=1">1</a>
                    </li>
                <?php endif; ?>

                <!-- Botón "Siguiente" -->
                <li class="<?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                    <a href="?page=<?php echo min($totalPages, $page + 1); ?>">&raquo;</a>
                </li>
            </ul>
        </section>

        <?php // Si hi ha un missatge, el mostrem ?>
        <?php if (isset($_SESSION['message'])) {
            $missatge = $_SESSION['message'];
            echo "<p class='missatge'>$missatge</p>";
            unset($_SESSION['message']); 
        } ?>
    </div>
</body>
</html>