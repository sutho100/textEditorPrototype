<?php
    require("php/header.php");

    // Start the session
    session_start();

    if ($_SESSION['login'] === 'success') {
	    // user already logged in
	} else {
		// redirect back to login.php
		session_destroy();
		header("Location: index.php");
	}    
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
            <div class="col-md-12 editor">   
                <div class="row editor-summary">     
                    <div class="col-xs-6 left">   
                        <p>           
                            <?php 
                                echo $_SESSION["fileName"];
                            ?>
                        </p>
                    </div>
                    <div class="col-xs-6 right">
                        <p>
                            <?php 
						        $_SESSION["fileUrl"] = '.' . '/' . $_SESSION["fileName"]; 
                                echo '<a href="editor.php" id="browserPreview">Edit</a>';                                         
					        ?>
                        </p>
                    </div>
                </div>
                <div class="editor-wrapper">                                        
                </div>
                <?php
					$_SESSION["fileUrl"] = '.' . '/' . $_SESSION["fileName"];
					echo('<iframe src="' . $_SESSION["fileUrl"] . '"></iframe>');
				?>
			</div>  
        </div>
        <?php require("php/footer.php") ?>
        <nav>
            <ul>
                <li id="navFiles">
                    <a href="#"><span class="nav-number">1</span>Files</a>
                </li>
                <li id="navEditor" class="nav-current">
                    <a href="#"><span class="nav-number">2</span>Edit</a>
                </li>
                <li id="navSave">
                    <a href="#"><span class="nav-number">3</span>Save</a>
                </li>
            </ul>
        </nav>
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
            echo("<script src='js/editor.js?version=" . hash_file('md5', 'js/editor.js') . "'></script>");
            echo("<script src='js/browser.js?version=" . hash_file('md5', 'js/browser.js') . "'></script>");
        } else {
            echo("<script src='js/main.es5.min.js?version=" . hash_file('md5', 'js/main.es5.min.js') . "'></script>");
            echo("<script src='js/editor.es5.min.js?version=" . hash_file('md5', 'js/editor.es5.min.js') . "'></script>");
            echo("<script src='js/browser.es5.min.js?version=" . hash_file('md5', 'js/browser.es5.min.js') . "'></script>");
        }
    ?>
</body>
</html>