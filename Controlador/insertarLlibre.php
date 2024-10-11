<?php
// Verifiaccions dels camps per poder anar a fer l'insert
include('../Model/llibres.php');

$missatge = '';
function comprovacioInsertarLlibre($titol, $cos) {
    if (empty($titol)) {
        return 'El titol no pot estar buit';
    }else if (empty($cos)) {
        return 'El cos no pot estar buit';
    }else {
        insertLlibre($titol, $cos);
        return 'Llibre insertat correctament';
    }
}
?>