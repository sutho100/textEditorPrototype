"use strict";

//---------------------------------------------
//click on a file to view
//---------------------------------------------
$(".files li a").click(function (event) {
    event.preventDefault();
    event.stopPropagation();

    var fileName = $(this).find('p').text();
    var lowerCaseFileName = fileName.toLowerCase();

    showLoading();

    if ($(this).parent("li").hasClass("folder")) {
        //open up folder

        var serverRequest = fileName;
        console.log('serverRequest ' + serverRequest);
        if ($(serverRequest).val() != 0) {
            $.post("php/enterDirectory.php", {
                fileName: serverRequest
            }, function (serverResponse) {
                if (serverResponse != "") {
                    console.log('php/enterDirectory.php ' + serverResponse);
                    showLoading();
                    showFiles();
                }
                hideLoading();
            });
        }
    } else if (lowerCaseFileName.search(".zip") > -1 || lowerCaseFileName.search(".ai") > -1 || lowerCaseFileName.search(".psd") > -1 || lowerCaseFileName.search(".flv") > -1 || lowerCaseFileName.search(".woff") > -1 || lowerCaseFileName.search(".woff2") > -1 || lowerCaseFileName.search(".ttf") > -1 || lowerCaseFileName.search(".eot") > -1 || lowerCaseFileName.search(".mp3") > -1 || lowerCaseFileName.search(".pdf") > -1) {
        //trigger download action instead of opening in browser or editor

        var serverRequest = fileName;
        if ($(serverRequest).val() != 0) {
            $.post("download.php", {
                fileName: serverRequest
            }, function (serverResponse) {
                if (serverResponse != "") {
                    console.log("download.php " + serverResponse);

                    //download the file
                    window.location = serverResponse;
                }
                hideLoading();
            });
        }
    } else if ($(this).parent("li").hasClass("folder-up")) {
        //go back up to previous folder

        var serverRequest = fileName;
        console.log('serverRequest ' + serverRequest);
        if ($(serverRequest).val() != 0) {
            $.post("php/exitDirectory.php", {
                fileName: serverRequest
            }, function (serverResponse) {
                if (serverResponse != "") {
                    console.log("php/exitDirectory.php " + serverResponse);
                    showLoading();
                    showFiles();
                }
                hideLoading();
            });
        }
    } else if ($(this).parent("li").hasClass("file")) {
        //send to php the name of file
        var serverRequest = fileName;
        if ($(serverRequest).val() != 0) {
            $.post("php/read.php", {
                fileName: serverRequest
            }, function (serverResponse) {
                if (serverResponse != "") {
                    console.log("php/read.php " + serverResponse);
                    showLoading();

                    //choose default action with file type                   
                    if (lowerCaseFileName.search(".swf") > -1 || lowerCaseFileName.search(".png") > -1 || lowerCaseFileName.search(".jpg") > -1 || lowerCaseFileName.search(".gif") > -1) {
                        showBrowser();
                    } else {
                        showEditor();
                    }
                }
                hideLoading();
            });
        }
    }
});

