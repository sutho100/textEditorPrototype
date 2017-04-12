<?php     
    // Start the session
    session_start();

    $fileContents = $_POST["fileContents"]; 

    //use local url as you can't write to an http file directly
    $fileRelativeUrl = $_SERVER['DOCUMENT_ROOT'] . $_SESSION["ftpPath"] . '/' . $_SESSION["fileName"];

    //save contents
    file_put_contents($fileRelativeUrl, $fileContents);

    echo($fileContents . ' ' . $fileRelativeUrl);
?>