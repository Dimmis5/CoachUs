<?php
session_start();
session_unset();
session_destroy();

header('Location: ../SPORTIF/connexion.php');
exit();
?>
