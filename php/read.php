<?php 
    // Start the session
    session_start();

    //get variable sent from Javascript
    $_SESSION["fileName"] = $_POST['fileName'];

    //construct url
    $_SESSION["fileUrl"] = '.' . '/' . $_SESSION["fileName"];

    $fileContents = file_get_contents($_SESSION["fileUrl"]);

    //send back to javascript
    echo($fileContents);
?>