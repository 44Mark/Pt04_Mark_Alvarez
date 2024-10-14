<?php
// Verifiaccions dels camps per poder anar a fer l'insert
include('../Model/llibres.php');

function comprovacioInsertarLlibre($titol, $cos) {
    if (empty($titol)) {
        $_SESSION['message'] = 'El titol no pot estar buit';
    } else if (empty($cos)) {
        $_SESSION['message'] = 'El cos no pot estar buit';
    } else {
        insertLlibre($titol, $cos);
        $_SESSION['message'] = 'Llibre insertat correctament';
    }
}
?>