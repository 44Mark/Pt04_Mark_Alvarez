<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
header("Location: /BackEnd/Pt04_Mark_Alvarez/inici");
exit();
?>