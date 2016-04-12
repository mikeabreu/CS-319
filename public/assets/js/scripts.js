/*  Go Game Go
 *
 *  File: scripts.js
 *
 *  Description:
 */
$j = jQuery.noConflict();
$j(document).ready(function() {
    // Initialize Button Collapse
    $j(".button-collapse").sideNav();

    // Initialize Modal
    $j('.modal-trigger').leanModal();

    // Initialize Select
    $j('select').material_select();

    // Initialize Parallax Images
    $j('.parallax').parallax();

});