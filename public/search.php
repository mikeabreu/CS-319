<?php
require_once "../includes/initialize.php";
global $session;
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
$show_results = false;
$admin_view = $session->is_admin();

if (isset($_GET["search-query"]) && !empty($_GET["search-query"])) {
    $show_results = true;
}

$page_title = 'Search';
$wrapper_class = 'search-view';
include(TEMPLATE_PATH . DS . 'header.php');

?>

<?php if ($admin_view) { ?>
    <!-- Edit Modal -->
    <div class="row">
        <div id="edit-modal" class="modal">
            <div class="modal-content container">
                <div class="row">
                    <h4>Edit Search Tags</h4>
                    <ul class="collection with-header">
                        <li class="collection-header"><h5>All Tags</h5></li>
                        <li class="collection-item"><div>Tag<a href="#!" class="secondary-content"><i class="material-icons red-text">delete</i></a></div></li>
                        <li class="collection-item"><div>Tag<a href="#!" class="secondary-content"><i class="material-icons red-text">delete</i></a></div></li>
                        <li class="collection-item"><div>Tag<a href="#!" class="secondary-content"><i class="material-icons red-text">delete</i></a></div></li>
                        <li class="collection-item"><div>Tag<a href="#!" class="secondary-content"><i class="material-icons red-text">delete</i></a></div></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col s9">
                        <input id="add_search_tag" type="text" class="validate">
                        <label class="active" for="add_search_tag">Add Search Tag</label>
                    </div>
                    <div class="col s1">
                        <button class="btn waves-effect waves-light green lighten-1" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Page Title -->
<div class="row">
    <div class="col s10 offset-s1">
        <h3 class="center">Game Search</h3>
    </div>
</div>

<!-- Search Field -->
<form name="search-form" action="search.php" method="get">
    <div class="row">
        <div class="input-field col s9 offset-s1">
            <i class="material-icons prefix">search</i>
            <input id="icon_prefix" type="text" class="validate" name="search-query">
            <label for="icon_prefix">Search</label>
        </div>
        <div class="input-field col s1">
            <button class="btn waves-effect waves-light green lighten-1" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>

<!-- Search Results -->
<?php if ($show_results) { ?>
    <div id="search-results" class="row">
        <ul class="collection col s10 offset-s1">
            <li class="collection-item avatar">
                <div class="row">
                    <img src="http://placehold.it/50x50" alt="" class="circle">
                    <span class="title">Game Title</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p><span class="search-tag">search-tags</span> <span class="search-tag">tag2</span></p>
                    <a href="#!" class="secondary-content"><i class="material-icons yellow-text text-darken-1">grade</i><i class="material-icons yellow-text text-darken-1">grade</i><i class="material-icons yellow-text text-darken-1">grade</i></a>
                </div>
                <div class="row">
                    <a class="modal-trigger waves-effect waves-light btn green lighten-1" href="#edit-modal"><i class="material-icons left">edit</i>Edit</a>
                </div>
            </li>
            <li class="collection-item avatar">
                <div class="row">
                    <img src="http://placehold.it/50x50" alt="" class="circle">
                    <span class="title">Game Title</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p><span class="search-tag">search-tags</span> <span class="search-tag">tag2</span></p>
                    <a href="#!" class="secondary-content"><i class="material-icons yellow-text text-darken-1">grade</i><i class="material-icons yellow-text text-darken-1">grade</i></a>
                </div>
                <div class="row">
                    <a class="modal-trigger waves-effect waves-light btn green lighten-1" href="#edit-modal"><i class="material-icons left">edit</i>Edit</a>
                </div>
            </li>
            <li class="collection-item avatar">
                <div class="row">
                    <img src="http://placehold.it/50x50" alt="" class="circle">
                    <span class="title">Game Title</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p><span class="search-tag">search-tags</span> <span class="search-tag">tag2</span></p>
                    <a href="#!" class="secondary-content"><i class="material-icons yellow-text text-darken-1">grade</i></a>
                </div>
                <div class="row">
                    <a class="modal-trigger waves-effect waves-light btn green lighten-1" href="#edit-modal"><i class="material-icons left">edit</i>Edit</a>
                </div>
            </li>
        </ul>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col s10 offset-s1">
            <ul class="pagination center">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active green lighten-1"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>
<?php } ?>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
