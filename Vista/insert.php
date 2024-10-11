<!-- Mark Alvarez -->
<!DOCTYPE html>
<html lang="es">
<head>
<?php
session_start(); 

include('./header.php'); 
?>
<link rel="stylesheet" href="Vista/estils.css"> <!-- Asegúrate de que la ruta al archivo CSS sea correcta -->
</head>
<body>
    <div class="insert">
        <h1>Creació d'articles</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">  
            <input type="hidden" name="accion" value="insertarLlibre">

            <label for="titol">Titol:</label>
            <input type="text" id="titol" name="titol" value="<?php if (isset($titol)) echo $titol; ?>">

            <label for="cos">Cos:</label>
            <textarea name="cos" rows="8" cols="20"><?php if (isset($cos)) echo $cos; ?></textarea>

            <input type="submit" value="Enviar" class="boton">
        </form>
        
        <button class="boton" onclick="window.location.href='./index.php';">Tornar al menu</button>
    </div>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include('../Controlador/insertarLlibre.php');
            $missatge = comprovacioInsertarLlibre($_POST['titol'], $_POST['cos']);
            echo "<p class='missatge'>$missatge</p>";
    }
    ?>
</body>
</html>