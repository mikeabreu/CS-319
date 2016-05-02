<?php
require_once('../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

$admin_view = $session->is_admin();
$page_title = 'News';
include(TEMPLATE_PATH . DS . 'header.php');

if (isset($_POST['submitted'])) {
    $errors = array();

    // Check if game name was submitted.
    if (empty($_POST['subject'])) {
        $errors[] = "Please enter a subject";
    } else {
        $clean_subject = $db->escape_value(trim($_POST['subject']));
    }

    // Check if platform was submitted.
    if (empty($_POST['content'])) {
        $errors[] = "Please enter content for your article.";
    } else {
        $clean_content = $db->escape_value($_POST['content']);
    }

    if (empty($errors)) {
        $article = new Article();
        $article->subject   =   $clean_subject;
        $article->content   =   $clean_content;
        $article->author    =   $_SESSION['username'];
        $article->datetime  =   date("Y-m-d H:i:s");
        Article::save($article);
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

if (isset($_GET["update_article"])) {
    $article = Article::find_by_id($_GET['article_id']);
    $article->subject   =   $db->escape_value(trim($_GET['new_subject']));
    $article->content   =   $db->escape_value($_GET['new_content']);
    Article::save($article);
}

if (isset($_GET["edit_row"])) {
    $id = $_GET["article_id"];
    $article = Article::find_by_id($id);
    ?>
    <div class="center-align">
        <h4>Edit Article</h4>
        <div class="row">
            <form class="form" action="news.php" method="get">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="" required autofocus name="new_subject" value="<?php echo $article->subject; ?>"/>
                        <label for="subject">Subject</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="" required name="new_content" value="<?php echo $article->content; ?>"/>
                        <label for="content">Content</label>
                    </div>
                </div>
                <div class="col s1">
                    <input type="hidden" name="previous" value="<?php echo "news.php?article_id=".$id."&edit_row=Edit"; ?>">
                    <input type="hidden" name="article_id" value="<?php echo $id; ?>">
                    <button class="btn waves-effect waves-light green lighten-1" type="submit" name="update_article" value="true">Update
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
    $id = $_GET["article_id"];
    $article_to_delete = Article::find_by_id($id);
    Article::delete($article_to_delete);
}

?>
<?php if ($admin_view) { ?>
    <!-- Add Modal -->
    <div class="row">
        <div id="add-modal" class="modal">
            <div class="modal-content container">
                <div class="row">
                    <h4>Fill out the form to add your article.</h4>
                    <form class="form" role="form" action="news.php" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="" required autofocus name="subject"/>
                                <label for="subject">Subject</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" class="" required name="content"/>
                                <label for="content">Content</label>
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
        <h1 class="center-align">News Page</h1>
        <?php if ($admin_view) { ?>
            <div class="center-align">
                <h4>Admin Options</h4>
                <a class="modal-trigger waves-effect waves-light btn blue lighten-1" href="#add-modal">Add Article</a>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col s10 offset-s1">
                <?php $articles = Article::find_all(); ?>

                <ul class="collection">
                <?php foreach ($articles as $article) { ?>
                    <li class="collection-item">
                        <div class="row valign-wrapper">
                            <div class="col s12 valign">
                                <h4>Subject: <?php echo $article->subject; ?></h4>
                            </div>
                        </div>
                        <div class="row valign-wrapper">
                            <div class="col s12 valign">
                                <h5>Content:</h5>
                                <p><?php echo $article->content; ?></p>
                            </div>
                        </div>
                        <div class="row valign-wrapper">
                            <div class="col s6 valign">
                                <h5>Author:</h5>
                                <h6><?php echo $article->author; ?></h6>
                            </div>
                            <div class="col s6 valign">
                                <h5>Date and Time:</h5>
                                <h6><?php echo $article->datetime; ?></h6>
                            </div>
                        </div>
                        <?php if ($admin_view) { ?>
                            <div class="row">
                                <div class="col s12">
                                    <form class="form" action="news.php" method="get">
                                        <input type="hidden" name="article_id" value="<?php echo $article->id; ?>">
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
