<?php 
    // Start the session
    session_start();

    //reset the fileName to new URL
    $_SESSION["fileName"] = $_POST['fileName'];

    //construct new url for the Files page to use
    $_SESSION["ftpPath"] = $_SESSION["ftpPath"] . "/" . $_SESSION["fileName"];

    //send back to javascript
    echo $_SESSION["ftpPath"];
?>