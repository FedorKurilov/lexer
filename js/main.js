$(function() {
    $obj = $("#code")[0]; // returns HTML DOM object
    $editor = CodeMirror.fromTextArea($obj, {
        lineNumbers: true,
        indentWithTabs: true,
        styleActiveLine: true,
        mode: "text/x-pascal"
    });
});
