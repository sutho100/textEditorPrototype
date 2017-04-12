<?php
    require("php/header.php");

    // Start the session
    session_start();  

    if ($_SESSION["login"] === "success") {
	    // user already logged in
	} else {
		// redirect back to login.php which will destroy the session
		header("Location: index.php");
	}    

    // Set session variables on first time only after login
    if ($_SESSION["firstTime"] === true) {
        switch ($_SESSION["username"]) {
            case "thinkzion":                            
                //ftp config
                $_SESSION["ftpDomain"] = "toddsutherlanddesigns.com";

                $_SESSION["ftpHost"] = "home627879253.1and1-data.host";
                $_SESSION["ftpPath"] = "ftpEditorTester";        

                //settings
                $_SESSION["acceptedFormats"] = array(
                    ".html", 
                    ".json", 
                    ".xml", 
                    ".css", 
                    ".txt", 
                    ".js",
                    ".png",
                    ".jpg"
                );
                $_SESSION["unacceptedFolders"] = array(".git");
                $_SESSION["navigateFolders"] = true;
                $_SESSION["ftpRootAccess"] = false;
                $_SESSION["createFilesAndFolders"] = false;
                //$_SESSION["lastUpdated"] = false;
                break;
            case "josh":
                //ftp config
                $_SESSION["ftpDomain"] = "joshwhalan.com";

                $_SESSION["ftpHost"] = "joshwhalan.com";
                $_SESSION["ftpPath"] = "httpdocs";

                //settings
                $_SESSION["acceptedFormats"] = array(
                    ".php", 
                    ".html", 
                    ".json", 
                    ".xml", 
                    ".css", 
                    ".txt", 
                    ".js"
                );
                $_SESSION["unacceptedFolders"] = array(".git");
                $_SESSION["navigateFolders"] = true;
                $_SESSION["ftpRootAccess"] = false;
                $_SESSION["createFilesAndFolders"] = false;
                //$_SESSION["lastUpdated"] = true;
                break;
            case "joel":
                //ftp config
                $_SESSION["ftpDomain"] = "joeldobbinsdesigns.com";

                $_SESSION["ftpHost"] = "home293932237.1and1-data.host";
                $_SESSION["ftpPath"] = "/ftpEditorTester";

                //settings
                $_SESSION["acceptedFormats"] = array(
                    ".php", 
                    ".html", 
                    ".json", 
                    ".xml", 
                    ".css", 
                    ".txt", 
                    ".js", 
                    ".jpg", 
                    ".png", 
                    ".gif", 
                    ".psd", 
                    ".ai", 
                    ".zip", 
                    ".flv",
                    ".woff",
                    ".woff2",
                    ".ttf",
                    ".svg",
                    ".eot",
                    ".mp3",
                    ".pdf"
                );
                $_SESSION["unacceptedFolders"] = array(".git");
                $_SESSION["navigateFolders"] = true;
                $_SESSION["ftpRootAccess"] = true;
                $_SESSION["createFilesAndFolders"] = true;
                //$_SESSION["lastUpdated"] = true;
                break;
            case "todd":
                //ftp config
                $_SESSION["ftpDomain"] = "toddsutherlanddesigns.com";

                $_SESSION["ftpHost"] = "home627879253.1and1-data.host";
                $_SESSION["ftpPath"] = "portfolio";

                //settings
                $_SESSION["acceptedFormats"] = array(
                    ".php", 
                    ".html", 
                    ".json", 
                    ".xml", 
                    ".css", 
                    ".txt", 
                    ".js"
                );
                $_SESSION["unacceptedFolders"] = array(".git");
                $_SESSION["navigateFolders"] = true;
                $_SESSION["ftpRootAccess"] = true;
                $_SESSION["createFilesAndFolders"] = false;
                //$_SESSION["lastUpdated"] = true;
                break;
            case "paul":
                //ftp config
                $_SESSION["ftpDomain"] = "joeldobbinsdesigns.com";

                $_SESSION["ftpHost"] = "joeldobbinsdesigns.com";
                $_SESSION["ftpPath"] = "/gnssMonitoring";

                //settings
                $_SESSION["acceptedFormats"] = array(
                    ".js", 
                    ".html", 
                    ".swf", 
                    ".zip");
                $_SESSION["unacceptedFolders"] = array(".git");
                $_SESSION["navigateFolders"] = true;
                $_SESSION["ftpRootAccess"] = false;
                $_SESSION["createFilesAndFolders"] = false;
                //$_SESSION["lastUpdated"] = true;
                break;
            default:
                // redirect back to login.php which will destroy the session      
		        header("Location: index.php");
        }   

        //set to be the first time
        $_SESSION["firstTime"] = false;  
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
            <div class="col-md-12">                 
                <div class="files">
                    <div class="row files-summary">
                    <div class="col-xs-6 left">
                        <p><?php echo($_SESSION["ftpDomain"]); ?></p>
                    </div>
                    <div class="col-xs-6 right">
                        <p><?php echo($_SESSION["ftpPath"]); ?></p>
                    </div>
                </div>     
                    <ul>
                        <?php
                            $files = array();
                            if ($handle = opendir('.')) {
                                while (false !== ($entry = readdir($handle))) {
                                    if ($entry != "." && $entry != "..") {
                                        array_push($files, $entry);
                                    }
                                }
                                closedir($handle);
                            }                       

                            //iterate through the files
                            if (count($files) > 1) {
                                for ($i = 0; $i <= count($files); $i++) {
                                    if (isset($files[$i])) {
                                        //start at 0 to skip over first 'back a directory' one
                                        if ($i > 0) {
                                            //if date is today, show the time instead of date
                                            $todayDate = date("d-m-Y");

                                            //only detect date if on server
                                            $sapi_type = php_sapi_name();
                                            if (substr($sapi_type, 0, 3) !== 'cgi') {
                                                $fileTimestamp = '1478789797';
                                            } else {
                                                $fileTimestamp = filemtime(str_replace($_SESSION["ftpPath"] . "/", "", $files[$i]));
                                            }
                                        
                                            $fileDate = date("d-m-Y", $fileTimestamp);                                      

                                            if ($todayDate === $fileDate) {
                                                $date = date("g:i a", $fileTimestamp);
                                            } else {                                       
                                                $date = date("d-m-Y", $fileTimestamp);
                                            }

                                            if (strpos($files[$i], '.') !== false) {
                                                //known files
                                                echo '<li class="file row"><a href="' . $files[$i] . '"><div class="name col-xs-6"><p>' . $files[$i] . '</p></div><div class="date-stamp col-xs-6">' . $date . '</div></a></li>';
                                            } else {
                                                //folder
                                                echo '<li class="folder row"><a href="' . $files[$i] . '"><div class="name col-xs-6"><p>' . $files[$i] . '</p></div><div class="date-stamp col-xs-6">' . $date . '</div></a></li>';
                                            }                  
                                        }
                                    }
                                } 

                                //add create new file or folder button
                                if ($_SESSION["createFilesAndFolders"]) {
                                    echo '<li class="read-only row"><div class="name col-xs-6"><p><a href="#">New File</a></p></div><div class="date-stamp col-xs-6"><p><a href="#">New Folder</a></p></div></li>';
                                }
                            } else {
                                echo "<div class='message'><p>This Folder is Either Empty, Does Not Exist or your FTP Server is Temporarily Down.</p><p><a href='files.php'>Try Again</a> in a Few Moments</p></div>";
                            }
                        ?>  
                    </ul>   
                </div>       
            </div>
        </div>
        <?php require("php/footer.php") ?>
        <nav>
            <ul>
                <li id="navFiles" class="nav-current">
                    <a href="#"><span class="nav-number">1</span>Files</a>
                </li>
                <li id="navEditor" class="nav-hide">
                    <a href="#"><span class="nav-number">2</span>Edit</a>
                </li>
                <li id="navSave" class="nav-hide">
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
            echo("<script src='js/files.js?version=" . hash_file('md5', 'js/index.js') . "'></script>");
        } else {
            echo("<script src='js/main.es5.min.js?version=" . hash_file('md5', 'js/main.es5.min.js') . "'></script>");
            echo("<script src='js/files.es5.min.js?version=" . hash_file('md5', 'js/index.es5.min.js') . "'></script>");
        }
    ?>
</body>
</html>