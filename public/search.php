<?php
require_once "../includes/initialize.php";
global $session;
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
$show_results = false;
$admin_view = $session->is_admin();

$page_title = 'Search';
$wrapper_class = 'search-view';
include(TEMPLATE_PATH . DS . 'header.php');

if (isset($_GET['delete_row'])) {
    if (isset($_GET['tag_id']) && !empty($_GET['tag_id'])) {
        $tag_to_delete = Tag::find_by_id($_GET['tag_id']);
        Tag::delete($tag_to_delete);
        $output = "Tag deleted";
    }
}

if (isset($_GET["search-query"]) && !empty($_GET["search-query"])) {
    $query = $db->escape_value(trim($_GET["search-query"]));
    $games = Game::find_all_by_pattern($query);
    if ($games) {
        $results = "<ul class=\"collection\">";
        foreach ($games as $game) {
            $results .= "<li class=\"collection-item\">";
            $results .= "<div class=\"row valign-wrapper\">";
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
            if ($admin_view) {
                $results .= "<div class=\"row\">";
                $results .= "<div class=\"col s12\">";
                $results .= "<form class=\"form\" action=\"search.php\" method=\"get\">";
                $results .= "<input type=\"hidden\" name=\"game_id\" value=\"" . $game->id . "\">";
                // $results .= "<input type=\"submit\" name=\"edit_row\" value=\"true\" class=\"btn green\">";
                $results .= "<button class=\"btn waves-effect waves-light green lighten-1\" type=\"submit\" name=\"edit_row\" value=\"true\">Edit<i class=\"material-icons right\">edit</i></button>";
                $results .= "</form>";
                $results .= "</div>";
                $results .= "</div>";
            }
            $results .= "</div>";
            $results .= "</li>";
        }
        $results .= "</ul>";
        $show_results = true;
    }
}

if (isset($_GET['addTag'])) {
    if (empty($_GET['tag_name'])) {
        redirect_to($_GET['previous']);
    } else {
        $new_tag = new Tag();
        $new_tag->game_id   =   $_GET['game_id'];
        $new_tag->tag_name  =   $db->escape_value(trim($_GET['tag_name']));
        Tag::save($new_tag);
        redirect_to($_GET['previous']);
    }
}

if (isset($_GET['edit_row'])) {
    if (!empty($_GET['game_id'])) {
        $current_game = Game::find_by_id($_GET['game_id']);
        ?>
        <div class="center-align">
            <h4>Edit Search Tags</h4>
            <?php
            $tags = Tag::find_all_by_game_id($current_game->id);
            $tag_list  = "<div class=\"row\"><div class=\"col s10 offset-s1\"><ul class=\"collection with-header\">";
            $tag_list .= "<li class=\"collection-header\"><h5>All Tags</h5></li>";
            if ($tags) {
                foreach($tags as $tag) {
                    $tag_list .= "<li class=\"collection-item\"><div>" . $tag->tag_name . "<a href=\"search.php?game_id=".$_GET['game_id']."&edit_row=true&tag_id=".$tag->id."&delete_row=true\" class=\"secondary-content\"><i class=\"material-icons red-text\">delete</i></a></div></li>";
                }
            }
            $tag_list .= "</ul></div></div>";
            echo $tag_list;
            ?>
            <div class="row">
                <form class="form" action="search.php" method="get">
                    <div class="col s9 offset-s1">
                        <input id="add_search_tag" type="text" class="validate" name="tag_name">
                        <label class="active" for="add_search_tag">Add Search Tag</label>
                    </div>
                    <div class="col s1">
                        <input type="hidden" name="previous" value="<?php echo "search.php?game_id=".$_GET['game_id']."&edit_row=true"; ?>">
                        <input type="hidden" name="game_id" value="<?php echo $_GET['game_id']; ?>">
                        <button class="btn waves-effect waves-light green lighten-1" type="submit" name="addTag" value="true">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php include_once(TEMPLATE_PATH . DS . "footer.php");
        exit();
    }
}

?>

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
            <button class="btn waves-effect waves-light green lighten-1" type="submit">Submit
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
