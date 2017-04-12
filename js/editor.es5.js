"use strict";

//---------------------------------------------
//get and update browser width
//---------------------------------------------
var windowWidth = 0;

//get width on initial load
$(document).ready(function () {
    windowWidth = $(window).width();
    //console.log("initial width " + windowWidth);

    //process line numbers
    processLineNumbers();
});

$(window).resize(function () {
    windowWidth = $(window).width();
    //console.log("resize width " + windowWidth);
});

//---------------------------------------------
//generate line numbers for the editor
//---------------------------------------------
function processLineNumbers() {
    if ($("#editorDiv").length > 0) {
        var lineHeight = parseInt($("#editorDiv").css('line-height'));
        var scrollHeight = $("#editorDiv")[0].scrollHeight;
        var numberOfLines = scrollHeight / lineHeight;

        for (var i = 1; i < numberOfLines; i++) {
            $('.line-numbers').append('<p>' + i + '</p>');
            //console.log(i);
        }

        //set width of line-numbers bar dynamically
        var maxWidth = 0;
        var widestSpan = null;
        var $element;
        $('#lineNumbers p').each(function () {
            $element = $(this);
            if ($element.width() > maxWidth) {
                maxWidth = $element.width();
                widestSpan = $element;
            }
        });

        var lineNumberExtraWidthPadding = 10;
        //console.log('widest width line numbers ' + maxWidth);
        $('#lineNumbers').css('width', maxWidth + lineNumberExtraWidthPadding + 'px');
        //$('#editorDiv').css('padding-left', maxWidth + lineNumberExtraWidthPadding + 'px');
        $('.editor-wrapper').css('padding-left', maxWidth + lineNumberExtraWidthPadding + 'px');
    }
}

//---------------------------------------------
//scroll line numbers as you scroll text
//---------------------------------------------
$("#editorDiv").on("scroll", function () {
    var lineNumberScrollPosition = -1 * $(this).scrollTop();
    //console.log('scrolled ' + lineNumberScrollPosition + 'px');
    $("#lineNumbers").css("top", lineNumberScrollPosition + "px");
});

//---------------------------------------------
//make tab add spaces rather than tabing to next element in the browser
//---------------------------------------------
$("#editorDiv").keydown(function (e) {
    if (e.keyCode == 9) {
        e.preventDefault();

        //add 4 spaces where the cursor is
        var text = '    ';
        var sel, range, html;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                range.insertNode(document.createTextNode(text));
            }
        } else if (document.selection && document.selection.createRange) {
            document.selection.createRange().text = text;
        }
    }
});

//---------------------------------------------
//handle the changing of text in the editor
//---------------------------------------------
$("#editorDiv").keyup(function (e) {
    console.log("keyup");

    processLineNumbers();
});

