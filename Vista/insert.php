<!-- Mark Alvarez -->
<!DOCTYPE html>
<html lang="es">
<head>
<?php
session_start(); 

include('./header.php'); 
?>

</head>
<body>
    <h1>Creació d'articles</h1>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="insert">  
            <input type="hidden" name="accion" value="insertarLlibre">

            <div class="contenedor-input">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="<?php if (isset($isbn)) echo $isbn; ?>">
            </div>

            <div class="contenedor-input">
                <label for="titol">Titol:</label>
                <input type="text" id="titol" name="titol" value="<?php if (isset($titol)) echo $titol; ?>">
            </div>

            <div class="contenedor-input">
                <label for="cos">Cos:</label>
                <textarea name="cos" rows="8" cols="92.5"><?php if (isset($cos)) echo $cos; ?></textarea>
            </div>

            <input type="submit" value="Enviar" class="button">
        </form>
        
        <button class="button" onclick="window.location.href='./index.php';">Tornar al menu</button>
        <?php
        // Si s'ha enviat el formulari, cridem a la funció comprovacioInsertarLlibre
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include('../Controlador/insertarLlibre.php');
            $missatge = comprovacioInsertarLlibre($_POST['isbn'], $_POST['titol'], $_POST['cos'], $_SESSION['correu']);
        }
        // Si hi ha un missatge, el mostrem
        if (isset($_SESSION['message'])) {
            $missatge = $_SESSION['message'];
            echo "<p class='missatge'>$missatge</p>";
            unset($_SESSION['message']);
        }
    ?>
    </div>

    
</body>
</html>