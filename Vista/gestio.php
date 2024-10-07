<!-- Mark Alvarez -->

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./header.php'); ?>
</head>
<body>

<div id="particles-js"></div>
    <div class="container">
        <h1>Gestió d'articles</h1>
        <table class="tablaUsuarios">
            <tr>
                <th>Descripció</th>
                <th>Acció</th>
            </tr>
            <tr>
                <td>Crear un nou article</td>
                <td><a href="./Vista/crear.php" class="botonindex">Crear article</a></td>
            </tr>
            <tr>
                <td>Modificar un article</td>
                <td><a href="./Vista/modificar.php" class="botonindex">Modificar</a></td>
            </tr>
            <tr>
                <td>Eliminar un article</td>
                <td><a href="./Vista/eliminar.php" class="botonindex">Eliminar</a></td>
            </tr>
        </table>
    </div>
</body>
</html>