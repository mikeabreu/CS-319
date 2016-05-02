<?php
require_once "../includes/initialize.php";
global $session;
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
$show_results = false;
$admin_view = $session->is_admin();
$current_game;

if (isset($_GET["search-query"]) && !empty($_GET["search-query"])) {
    $query = $db->escape_value(trim($_GET["search-query"]));
    $games = Game::find_all_by_pattern($query);
    if ($games) {
        $results = "<ul class=\"collection\">";
        foreach ($games as $game) {
            $current_game = $game;
            echo print_r($current_game);
            $results .= "<li class=\"collection-item\">";
            $results .= "<div class=\"row valign-wrapper\">";
            if ($admin_view) {
                $results .= "<div class=\"col s1 valign\">";
                $results .= "<a class=\"modal-trigger waves-effect waves-light btn green lighten-1\" href=\"#edit-modal". $game->id ."\">Edit Tags</a>";
                $results .= "</div>";
            }
            $results .= "<div class=\"col s1 valign\">";
            $results .= "<img class=\"boxart\" src=\"" . $game->image . "\" alt=\"\" />";
            $results .= "</div>";
            $results .= "<div class=\"col s2 valign\">";
            $results .= "<h6>" . $game->game_name . "</h6>";
            $results .= "</div>";
            $results .= "<div class=\"col s2 valign\">";
            $results .= "<h6>" . $game->platform . "</h6>";
            $results .= "</div>";
            $results .= "<div class=\"col s2 valign\">";
            $results .= "<h6>" . $game->genre . "</h6>";
            $results .= "</div>";
            $results .= "<div class=\"col s4 valign\">";
            $results .= "<h6>" . $game->description . "</h6>";
            $results .= "</div>";
            $results .= "</div>";
            $results .= "</li>";
        }
        $results .= "</ul>";
        $show_results = true;
    }
}

if (isset($_POST['addTag'])) {
    if (empty($_POST['tag_name'])) {
        echo "Please enter a tag name before submitting.";
    } else {
        $new_tag = new Tag();
        $new_tag->game_id   =   $_POST['game_id'];
        $new_tag->tag_name  =   $db->escape_value(trim($_POST['tag_name']));
        Tag::save($new_tag);
    }
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
                    <?php
                    echo "<br />" . print_r($current_game);
                    $tags = Tag::find_all_by_game_id($current_game->id);
                    $tag_list  = "<ul class=\"collection with-header\">";
                    $tag_list .= "<li class=\"collection-header\"><h5>All Tags</h5></li>";
                    if ($tags) {
                        foreach($tags as $tag) {
                            $tag_list .= "<li class=\"collection-item\"><div>" . $tag->tag_name . "<a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons red-text\">delete</i></a></div></li>";
                        }
                    }
                    $tag_list .= "</ul>";
                    ?>
                </div>

                <div class="row">
                    <form class="form" name="add-tag-form" action="search.php" method="POST">
                        <div class="col s9">
                            <input id="add_search_tag" type="text" class="validate" name="tag_name">
                            <label class="active" for="add_search_tag">Add Search Tag</label>
                        </div>
                        <div class="col s1">
                            <input type="hidden" name="game_id" value="<?php $current_game->id ?>">
                            <button class="btn waves-effect waves-light green lighten-1" type="submit" name="addTag">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
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
        <?php if (isset($results) && !empty($results)) {
            echo $results;
        } ?>
    </div>
<?php } ?>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
