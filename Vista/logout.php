<?php
session_start();
session_unset();
session_destroy();
header("Location: /BackEnd/Pt04_Mark_Alvarez/inici");
exit();
?>