<?php
    session_start();
    session_destroy();
    Header("Location: ../sign-in.php");
?>