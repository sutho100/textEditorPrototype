<?php 
    // Start the session
    session_start();

    //reset the fileName to new URL
    $_SESSION["fileName"] = $_POST['fileName'];
    


    //construct new URL for the Files page to use
    //$_SESSION["ftpPath"] = substr($_SESSION["ftpPath"], 0, strrpos($_SESSION["ftpPath"], "/"));
    if (strpos($_SESSION["ftpPath"], '/', 1) && strpos($_SESSION["ftpPath"], '/') !== true) {
        $_SESSION["ftpPath"] = substr($_SESSION["ftpPath"], 0, strrpos($_SESSION["ftpPath"], "/"));
    } else if ($_SESSION["ftpRootAccess"] === true) {
        $_SESSION["ftpPath"] = '.';
    } else {
        //keep the same
    }
    

    //send back to javascript
    echo $_SESSION["ftpPath"];
?>