<?php
    require("php/header.php");

    //added because of tutorial for login page
    ob_start();

    //Destroy all traces of the old session
    session_start();
    session_unset();
    session_destroy();
    session_write_close();

    //Start new session
    session_start();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
 <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>FTP Editor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="theme-color" content="#002b36" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link href="js/vendor/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.min.css?version=<?php echo hash_file('md5', 'css/main.min.css'); ?>">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <!--<script src="js/vendor/screenfull.min.js"></script>-->
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="container">        
        <div class="row">
            <div class="col-md-12">                 
                <div class="files">
                    

                <?php
                    $msg = "FTP Editor";
            
                    if (isset($_POST["login"]) && !empty($_POST["username"]) 
                       && !empty($_POST["password"])) {
				
                        if (($_POST["username"] === "thinkzion") && ($_POST["password"] === "1234")) {
                            $_SESSION["username"] = "thinkzion";
                            $_SESSION["login"] = "success";   
                            $_SESSION["firstTime"] = true;                         
                  
                            header("Location: files.php");
                        } else if (($_POST["username"] === "josh") && ($_POST["password"] === "josh")) {
                            $_SESSION["username"] = "josh";
                            $_SESSION["login"] = "success";   
                            $_SESSION["firstTime"] = true;                           
                  
                            header('Location: files.php');
                        } else if (($_POST["username"] === "joel") && ($_POST["password"] === "#noregrets")) {
                            $_SESSION["username"] = "joel";
                            $_SESSION["login"] = "success";    
                            $_SESSION["firstTime"] = true;                          
                  
                            header("Location: files.php");
                        } else if (($_POST["username"] === "todd") && ($_POST["password"] === "#noregrets")) {
                            $_SESSION["username"] = "todd";
                            $_SESSION["login"] = "success";    
                            $_SESSION["firstTime"] = true;                          
                  
                            header("Location: files.php");
                        } else if (($_POST["username"] === "paul") && ($_POST["password"] === "paul")) {
                            $_SESSION["username"] = "paul";
                            $_SESSION["login"] = "success";    
                            $_SESSION["firstTime"] = true;                          
                  
                            header("Location: files.php");
                        } else {
                            $msg = "Wrong username or password";
                        }
                    }
                ?>
                    <form class="form-signin" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                        <h4 class="form-signin-heading"><?php echo $msg; ?>&nbsp;</h4>
                        <input type="text" class = "form-control" name = "username" placeholder="username = thinkzion" required autofocus />
                        <input type="password" class="form-control" name="password" placeholder="password = 1234" required />
                        <input type="submit" name="login" value="Login"/>
                    </form>
                </div>       
            </div>
        </div>
        <?php require("php/footer.php") ?>      
        <div class="loader">
            <p>Loading. Please wait</p>
            <noscript><p>Sorry, JavaScript is required to be turned on for this site.<br/>For more info, see <a href="http://enable-javascript.com/">How to enable JavaScript in your browser</a></p></noscript>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/vendor/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.es5.min.js"></script>
    <?php
        //check if running on localhost as opposed to the server
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) !== 'cgi') {
            echo("<script src='js/main.js?version=" . hash_file('md5', 'js/main.js') . "'></script>");
            echo("<script src='js/index.js?version=" . hash_file('md5', 'js/index.js') . "'></script>");
        } else {
            echo("<script src='js/main.es5.min.js?version=" . hash_file('md5', 'js/main.es5.min.js') . "'></script>");
            echo("<script src='js/index.es5.min.js?version=" . hash_file('md5', 'js/index.es5.min.js') . "'></script>");
        }
    ?>
</body>
</html>