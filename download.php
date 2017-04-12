<?php 
    // Start the session
    session_start();

    //reset the fileName to new URL
    $_SESSION["fileName"] = $_POST['fileName'];

    //send back to javascript
    $constructedURLForDownload =  $_SESSION["ftpDomain"] . $_SESSION["ftpPath"] . '/' . $_SESSION["fileName"];
    echo str_replace(' ', '%20', $constructedURLForDownload);
?>