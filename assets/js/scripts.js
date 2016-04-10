/*  Go Game Go
 *
 *  File: scripts.js
 *
 *  Description:
 */
$j = jQuery.noConflict();
$j(document).ready(function() {
    $j(".button-collapse").sideNav();

    $j('.modal-trigger').leanModal();

    $j('select').material_select();

    $j('.parallax').parallax();

    function register(path) {
        window.location.href = path;
    }
});