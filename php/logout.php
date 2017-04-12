<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION['login']);

   if(!isset($_SESSION['login'])){ 
        //if login in session is not set
        session_destroy();
        header("Location: ../index.php");
    }
?>