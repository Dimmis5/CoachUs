<?php
session_start();
session_unset();
session_destroy();

header('Location: ../COACH/connexion.php');
exit();
?>
