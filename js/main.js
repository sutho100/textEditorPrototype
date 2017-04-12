"use strict";
//---------------------------------------------
//Turn off loader after initial load
//---------------------------------------------
var showLoading = function () {
    $('.loader').show();
};

var hideLoading = function () {
    $('.loader').hide();
};

hideLoading();

//---------------------------------------------
//set heights dynamically for iframe and browser
//---------------------------------------------
var windowHeight = $(window).height();
var headerHeight = $('nav').height();
var FooterHeight = $('footer').height();
var totalGapsHeight = 80;
//$('.editor #editorDiv, .editor iframe').height((windowHeight - headerHeight - headerHeight - FooterHeight - totalGapsHeight) / 2);
$('.editor #editorDiv').height((windowHeight - headerHeight - headerHeight - FooterHeight - totalGapsHeight));
$('.editor iframe').height((windowHeight - headerHeight - headerHeight - FooterHeight - totalGapsHeight));

//---------------------------------------------
//Get date for footer
//---------------------------------------------
$('#footerDate').text(new Date().getFullYear());

//---------------------------------------------
//submit to be saved
//---------------------------------------------
$("#navSave").click(function (event) {
    event.preventDefault();

    showLoading();

    var fileContents = $('#editorDiv').text();
    //console.log('fileContents ' + fileContents);
    
    //send to php the name of file
    var serverRequest = fileContents;
    if ($(serverRequest).text()) {
        console.log('start saving');        
        $.post("php/save.php", {
            fileContents: serverRequest
        }, function (serverResponse) {
            if (serverResponse != "") {
                console.log('php/save.php '.serverResponse);
                location.reload();
            }
            hideLoading();
        });
    }
});


//---------------------------------------------
//handle pages
//---------------------------------------------
$("nav a").click(function (event) {
    event.preventDefault();

    if (!$(this).parent('li').hasClass('nav-hide')) {
        switch ($(this).parent('li').attr('id')) {
            case 'navFiles':
                console.log('navFiles');
                showFiles();
                break;
            case 'navEditor':
                console.log('navEditor');
                showEditor();
                break;
            case 'navSave':
                console.log('navSave');
                showSave();
                break;
            case 'navGit':
                console.log('navGit');
                showGit();
                break;
            default:
                console.log('navFiles');
                showFiles();                
        }
    } 
});


var showFiles = function () {
    //navigate
    window.location.href = "files.php";
};

var showEditor = function () {
    //navigate
    window.location.href = "editor.php";
};

var showBrowser = function () {
    //navigate
    window.location.href = "browser.php";
};

var showSave = function () {
    //don't navigate
};

var showGit = function () {
    //navigate
    window.location.href = "git.php";
};

//---------------------------------------------
//prevent clicking through loader background
//---------------------------------------------
$('.loader').click(function (e) {
    e.stopPropagation();
});

//---------------------------------------------
//full screen
//---------------------------------------------
/*document.getElementById('editorDiv').addEventListener('click', () => {
    if (screenfull.enabled) {
        screenfull.request();
    } else {
        // Ignore or do something else
    }
});*/

//---------------------------------------------
//Preload Images
//---------------------------------------------
$.preloadImages = function () {
    for (var i = 0; i < arguments.length; i++) {
        $('<img />').attr('src', arguments[i]);
    }
};

$.preloadImages(
    "img/folder-hover.png",
    "img/file-hover.png",
    "img/folder-up-hover.png"
);