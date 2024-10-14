<?php
require('../Model/llibres.php');

function comprovacioInsertarLlibre($titol, $cos, $correu) {
    if (empty($titol)) {
        $_SESSION['message'] = 'El titol no pot estar buit';
    } else if (empty($cos)) {
        $_SESSION['message'] = 'El cos no pot estar buit';
    } else {
        insertLlibre($titol, $cos,$correu);
        $_SESSION['message'] = 'Llibre insertat correctament';
    }
}
?>