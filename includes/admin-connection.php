<?php
session_start();
if(!$_SESSION["username"] or ($_SESSION['level']!='U')!=1) {
    Header("Location: ../../sign-in.php"); 
}?>