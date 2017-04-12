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
<!ATTLIST codeAttribute codeId CDATA #IMPLIED>
<!ATTLIST codeTag codeId CDATA #IMPLIED>
<!ATTLIST codeComment codeId CDATA #IMPLIED>
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
						        $_SESSION["fileUrl"] = $_SESSION["ftpDomain"] . $_SESSION["ftpPath"] . '/' . $_SESSION["fileName"];   
					        ?>
                            <a href="browser.php" id="browserPreview">Preview</a>
                        </p>
                    </div>
                </div>
                <div class="editor-wrapper">   
                    <div class="line-numbers" id="lineNumbers">
                    </div>                     
                    <div id="editorDiv" class="editor-div" name="fileContents" contenteditable="true" spellcheck="false">
                        <code>
                            <?php
                                //generate id number incrementally for colouring spans
                                $_SESSION["idNumberIncrement"] = 0;
                                function generateIdNumber() {
                                    $_SESSION["idNumberIncrement"] = $_SESSION["idNumberIncrement"] + 1;
                                    return $_SESSION["idNumberIncrement"];
                                }

						        $fileContents = file_get_contents('.' . '/' . $_SESSION["fileName"]);

                                //encode them first so you can see them 
                                $fileContents = htmlentities($fileContents);

                                //initial clean up
                                //$fileContents = str_replace("&lt;br&gt;", "", $fileContents);                                

                                
                                //html tags
                                $fileContents = str_replace("doctype", "<codeTag>doctype</codeTag>", $fileContents);

                                $fileContents = str_replace("&lt;head", "<br><<codeTag>head</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/head&gt;", "<br>&lt;/<codeTag>head</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace("&lt;body&gt;", "<br><<codeTag>body</codeTag>>", $fileContents);
                                $fileContents = str_replace("&lt;body ", "<br><<codeTag>body</codeTag> ", $fileContents);
                                $fileContents = str_replace("&lt;/body&gt;", "<br>&lt;/<codeTag>body</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace("&lt;footer&gt;", "<br><<codeTag>footer</codeTag>>", $fileContents);
                                $fileContents = str_replace("&lt;footer ", "<br><<codeTag>footer</codeTag> ", $fileContents);
                                $fileContents = str_replace("&lt;/footer&gt;", "<br>&lt;/<codeTag>footer</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace("&lt;p ", "<br><<codeTag codeId='" . generateIdNumber() . "'>p </codeTag>", $fileContents);

                                $fileContents = str_replace("&lt;p&gt;", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>p</codeTag>&gt;", $fileContents);
                                $fileContents = str_replace("&lt;/p&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>p</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace("&lt;script", "<br><<codeTag codeId='" . generateIdNumber() . "'>script</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/script&gt;", "&lt;/<codeTag>script</codeTag>&gt;<br>", $fileContents);                               

                                $fileContents = str_replace("&lt;nav", "<br><<codeTag codeId='" . generateIdNumber() . "'>nav</codeTag><br>", $fileContents);
                                $fileContents = str_replace("&lt;/nav&gt;", "<br>&lt;/<codeTag codeId='" . generateIdNumber() . "'>nav</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace(" &lt;a ", " <<codeTag codeId='" . generateIdNumber() . "'>a</codeTag> ", $fileContents);
                                $fileContents = str_replace("&lt;a ", "<br><<codeTag codeId='" . generateIdNumber() . ">a</codeTag> ", $fileContents);
                                $fileContents = str_replace("&lt;/a&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>a</codeTag>&gt;<br>", $fileContents);                                

                                $fileContents = str_replace(" &lt;h1", " &lt;<codeTag codeId='" . generateIdNumber() . "'>h1</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;h1", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>h1</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/h1&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>h1</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace(" &lt;h2", " &lt;<codeTag codeId='" . generateIdNumber() . "'>h2</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;h2", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>h2</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/h2&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>h2</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace(" &lt;h4", " &lt;<codeTag codeId='" . generateIdNumber() . "'>h4</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;h4", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>h4</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/h4&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>h4</codeTag>&gt;<br>", $fileContents);

                                $fileContents = str_replace("&lt;div", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>div</codeTag>", $fileContents);
                                $fileContents = str_replace("&lt;/div&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>div</codeTag>&gt;<br>", $fileContents);

                                //$fileContents = str_replace("&lt;map", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>map</codeTag>", $fileContents);
                                //$fileContents = str_replace("&lt;/map&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>map</codeTag>&gt;<br>", $fileContents);

                                //$fileContents = str_replace("&lt;object", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>object</codeTag>", $fileContents);
                                //$fileContents = str_replace("&lt;/object&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>object</codeTag>&gt;<br>", $fileContents);
                                
                                //$fileContents = str_replace("&lt;title&gt;", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>title</codeTag>>", $fileContents);
                                //$fileContents = str_replace("&lt;/title&gt;", "&lt;/<codeTag codeId='" . generateIdNumber() . "'>title</codeTag>&gt;<br>", $fileContents);

                                //$fileContents = str_replace("&lt;strong&gt;", "<<codeTag codeId='" . generateIdNumber() . "'>strong</codeTag>>", $fileContents);
                                //$fileContents = str_replace("&lt;/strong&gt;", "</<codeTag codeId='" . generateIdNumber() . "'>strong</codeTag>>", $fileContents);

                                //$fileContents = str_replace('&lt;!--', '<br><codeComment codeId="' . generateIdNumber() . '">&lt;!--', $fileContents);
                                //$fileContents = str_replace('--&gt;','--&gt;</codeComment><br>', $fileContents);

                                //tags with attributes
                                //$fileContents = str_replace("&lt;html", "<br><<codeTag codeId='" . generateIdNumber() . "'>html</codeTag>", $fileContents);
                                //$fileContents = str_replace("&lt;/html&gt;", "<br>&lt;/<codeTag codeId='" . generateIdNumber() . "'>html</codeTag>&gt;<br>", $fileContents);
                                
                                //self closing tags with attributes
                                //$fileContents = str_replace("&lt;link", "<br>&lt;<codeTag codeId='" . generateIdNumber() . "'>link</codeTag>", $fileContents);
                                //$fileContents = str_replace("&lt;meta", "<br><<codeTag codeId='" . generateIdNumber() . "'>meta</codeTag>", $fileContents);
                                //$fileContents = str_replace("&lt;img ", "<br><<codeTag codeId='" . generateIdNumber() . "'>img</codeTag> ", $fileContents);
                                //$fileContents = str_replace("&lt;br ", "<br><<codeTag codeId='" . generateIdNumber() . "'>br</codeTag> ", $fileContents);
                                //$fileContents = str_replace("&lt;param ", "<br><<codeTag codeId='" . generateIdNumber() . "'>param</codeTag> ", $fileContents);
                                
                                //attributes
                                $fileContents = str_replace(' class=', ' <codeAttribute codeId="' . generateIdNumber() . '">class=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' id=', ' <codeAttribute codeId="' . generateIdNumber() . '">id=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' lang=', ' <codeAttribute codeId="' . generateIdNumber() . '">lang=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' name=', ' <codeAttribute codeId="' . generateIdNumber() . '">name=</codeAttribute>', $fileContents);                                
                                $fileContents = str_replace(' content=', ' <codeAttribute codeId="' . generateIdNumber() . '">content=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' rel=', ' <codeAttribute codeId="' . generateIdNumber() . '">rel=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' href=', ' <codeAttribute codeId="' . generateIdNumber() . '">href=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' http-equiv=', ' <codeAttribute codeId="' . generateIdNumber() . '">http-equiv=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' charset=', ' <codeAttribute codeId="' . generateIdNumber() . '">charset=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' src=', ' <codeAttribute codeId="' . generateIdNumber() . '">src=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' width=', ' <codeAttribute codeId="' . generateIdNumber() . '">width=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' height=', ' <codeAttribute codeId="' . generateIdNumber() . '">height=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' onmouseout=', ' <codeAttribute codeId="' . generateIdNumber() . '">onmouseout=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' onmouseover=', ' <codeAttribute codeId="' . generateIdNumber() . '">onmouseover=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' alt=', ' <codeAttribute codeId="' . generateIdNumber() . '">alt=</span>', $fileContents);                                
                                $fileContents = str_replace(' border=', ' <codeAttribute codeId="' . generateIdNumber() . '">border=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' value=', ' <codeAttribute codeId="' . generateIdNumber() . '">value=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' title=', ' <codeAttribute codeId="' . generateIdNumber() . '">title=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' type=', ' <codeAttribute codeId="' . generateIdNumber() . '">type=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' xmlns=', ' <codeAttribute codeId="' . generateIdNumber() . '">xmlns=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' coords=', ' <codeAttribute codeId="' . generateIdNumber() . '">coords=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' shape=', ' <codeAttribute codeId="' . generateIdNumber() . '">shape=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' target=', ' <codeAttribute codeId="' . generateIdNumber() . '">target=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' onload=', ' <codeAttribute codeId="' . generateIdNumber() . '">onload=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' classid=', ' <codeAttribute codeId="' . generateIdNumber() . '">classid=</codeAttribute>', $fileContents);
                                $fileContents = str_replace(' usemap=', ' <codeAttribute codeId="' . generateIdNumber() . '">usemap=</codeAttribute>', $fileContents);


                                //$fileContents = str_replace("/&gt;", '/><br>', $fileContents);

                                //remove multiples of br
                                //$fileContents = str_replace("&lt;br&gt;&lt;br&gt;", '<br>', $fileContents);

                                //encode html characters
                                //$fileContents = str_replace("&quot;", '"', $fileContents);
                                //$fileContents = str_replace("&nbsp;", " ", $fileContents);

                                //trim used to stop extra lines being added every time you save
						        echo trim($fileContents);
                            ?>
                        </code>
                    </div>                    
                </div>
                <?php
					$_SESSION["fileUrl"] = '.' . '/' . $_SESSION["fileName"];
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
                <!--<li id="navGit">
                    <a href="#"><span class="nav-number">4</span>Git</a>
                </li>-->
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
        } else {
            echo("<script src='js/main.es5.min.js?version=" . hash_file('md5', 'js/main.es5.min.js') . "'></script>");
            echo("<script src='js/editor.es5.min.js?version=" . hash_file('md5', 'js/editor.es5.min.js') . "'></script>");
        }
    ?>
</body>
</html>