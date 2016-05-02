<?php
require_once('../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

$admin_view = $session->is_admin();
$page_title = 'Game Catalog';
include(TEMPLATE_PATH . DS . 'header.php');

if (isset($_GET['submitted'])) {
    $errors = array();

    // Check if game name was submitted.
    if (empty($_GET['game_name'])) {
        $errors[] = "Please enter a game name.";
    } else {
        $clean_name = $db->escape_value(trim($_GET['game_name']));
    }

    // Check if platform was submitted.
    if (empty($_GET['platform'])) {
        $errors[] = "Please enter a platform.";
    } else {
        $clean_platform = $db->escape_value(trim($_GET['platform']));
    }

    // Check if genre was submitted.
    if (empty($_GET['genre'])) {
        $errors[] = "Please enter a genre.";
    } else {
        $clean_genre = $db->escape_value(trim($_GET['genre']));
    }

    // Check if description was submitted.
    if (empty($_GET['description'])) {
        $errors[] = "Please enter a description.";
    } else {
        $clean_description = $db->escape_value(trim($_GET['description']));
    }

    // Check if image was submitted.
    if (empty($_GET['image'])) {
        $errors[] = "Please enter an image url.";
    } else {
        $clean_image = $db->escape_value(trim($_GET['image']));
    }

    if (empty($errors)) {
        // echo "Your values are: ";
        // echo $gn . " " . $p . " " . $g . " " . $d . " " . $i;
        $game = new Game();
        $game->game_name    =   strtolower($clean_name);
        $game->platform     =   $clean_platform;
        $game->genre        =   $clean_genre;
        $game->description  =   $clean_description;
        $game->image        =   $clean_image;
        Game::save($game);
    } else { // Report the errors.

        $output_msg = '<strong>Error!</strong>';
        $output_msg .= '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            $output_msg .= " - $msg<br />\n";
        }
        $output_msg .= '</p><p>Please try again.</p>';
        $options["center"] = false;
        $options["card"] = true;
        $options["card_color"] = "red";
        $options["card_color_extra"] = "lighten-3";
        $options["col"] = 's8 offset-s2 l6 offset-l3';
        echo $Formatter->format($output_msg, $options);
    }
}

if (isset($_GET["update_game"])) {
    $game = Game::find_by_id($_GET['game_id']);
    $game->game_name    =   strtolower($db->escape_value(trim($_GET['new_game_name'])));
    $game->platform     =   $db->escape_value(trim($_GET['new_platform']));
    $game->genre        =   $db->escape_value(trim($_GET['new_genre']));
    $game->description  =   $db->escape_value(trim($_GET['new_description']));
    $game->image        =   $db->escape_value(trim($_GET['new_image']));
    Game::save($game);
}

if (isset($_GET["edit_row"])) {
    $id = $_GET["game_id"];
    $game = Game::find_by_id($id);
    ?>
    <div class="center-align">
        <h4>Edit Game</h4>
        <div class="row">
            <form class="form" action="catalog.php" method="get">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="" required autofocus name="new_game_name" maxlength="40"
                               value="<?php echo $game->game_name; ?>"/>
                        <label for="new_game_name">Game Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="" required name="new_platform" maxlength="40"
                               value="<?php echo $game->platform; ?>"/>
                        <label for="new_platform">Platform</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="" required name="new_genre" maxlength="40"
                               value="<?php echo $game->genre; ?>"/>
                        <label for="new_genre">Genre</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="" required name="new_description"
                               value="<?php echo $game->description; ?>"/>
                        <label for="new_description">Description</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="" required name="new_image"
                               value="<?php echo $game->image; ?>"/>
                        <label for="new_image">Image URL</label>
                    </div>
                </div>
                <div class="col s1">
                    <input type="hidden" name="previous" value="<?php echo "catalog.php?game_id=".$id."&edit_row=Edit"; ?>">
                    <input type="hidden" name="game_id" value="<?php echo $id; ?>">
                    <button class="btn waves-effect waves-light green lighten-1" type="submit" name="update_game" value="true">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include_once(TEMPLATE_PATH . DS . "footer.php");
    exit();
}

if (isset($_GET["delete_row"])) {
    $id = $_GET["game_id"];
    $game_to_delete = Game::find_by_id($id);
    Game::delete($game_to_delete);
}

?>
<?php if ($admin_view) { ?>
    <!-- Edit Modal -->
    <div class="row">
        <div id="add-modal" class="modal">
            <div class="modal-content container">
                <div class="row">
                    <h4>Fill out the form to add your game.</h4>
                    <form class="form" role="form" action="catalog.php" method="get">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="" required autofocus name="game_name" maxlength="40"/>
                                <label for="game_name">Game Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="" required name="platform" maxlength="40"/>
                                <label for="platform">Platform</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="" required name="genre" maxlength="40"/>
                                <label for="genre">Genre</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="" required name="description"/>
                                <label for="description">Description</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="" required name="image"/>
                                <label for="image">Image URL</label>
                            </div>
                            <div class="input-field col s12">
                                <button type="submit" name="submit" class="btn waves-effect waves-light green"/>
                                Submit
                                <i class="material-icons right">send</i>
                                </button>
                                <input type="hidden" name="submitted" value="TRUE"/>
                            </div>
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
<div class="row">
    <div class="col s12">
        <h1 class="center-align">Game Catalog Page</h1>
        <?php if ($admin_view) { ?>
            <div class="center-align">
                <h4>Admin Options</h4>
                <a class="modal-trigger waves-effect waves-light btn blue lighten-1" href="#add-modal">Add Game</a>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col s10 offset-s1">
                <?php $games = Game::find_all(); ?>

                <ul class="collection">
                <?php foreach ($games as $game) { ?>
                    <li class="collection-item">
                        <div class="row valign-wrapper">
                            <div class="col s2 valign">
                                <img class="boxart" src="<?php echo $game->image; ?>" alt="" />
                            </div>
                            <div class="col s2 valign">
                                <h6><?php echo $game->game_name; ?></h6>
                            </div>
                            <div class="col s2 valign">
                                <h6><?php echo $game->platform; ?></h6>
                            </div>
                            <div class="col s2 valign">
                                <h6><?php echo $game->genre; ?></h6>
                            </div>
                            <div class="col s4 valign">
                                <h6><?php echo $game->description; ?></h6>
                            </div>
                        </div>
                        <?php if ($admin_view) { ?>
                            <div class="row">
                                <div class="col s12">
                                    <form class="form" action="catalog.php" method="get">
                                        <input type="hidden" name="game_id" value="<?php echo $game->id; ?>">
                                        <input type="submit" name="edit_row" value="Edit" class="btn green">
                                        <input type="submit" name="delete_row" value="Delete" class="btn red">
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
