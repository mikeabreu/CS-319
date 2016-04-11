<?php
include_once('config.php');
//include('includes/session.php');
//echo print_r($_SESSION);

if (!isset($container_type)) {
    $container_type = 'container-full';
}
if (isset($valign) && $valign) {
    $container_type = 'container';
}
if (!isset($page_title) || empty($page_title)) {
    $page_title = "Title";
}


?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?> | G3</title>
    <!-- === Fonts === -->
    <!-- Materialize Font -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- === Stylesheets === -->
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="assets/css/materialize.min.css">
    <!-- G3 CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">

    <!--[if lt IE 9]>
    <script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">
    <!-- | Header | -->
    <header id="header" class="">
        <!-- | Navigation | -->
        <div class="navbar-fixed">
            <nav class="<?php echo G_COLOR; ?> <?php echo G_SHADE; ?>" role="navigation">
                <div class="nav-wrapper container-full">
                    <div class="row">
                        <div class="col s10 offset-s1"><!-- Logo -->
                            <a href="index.php" id="logo-container" class="brand-logo">G3</a>

                            <!-- Menu Links -->
                            <ul class="right hide-on-med-and-down">
                                <?php include("includes/templates/partials/nav_links.php"); ?>
                            </ul>

                            <!-- Mobile Menu Links -->
                            <ul id="nav-mobile" class="side-nav <?php echo G_COLOR . ' ' . G_SHADE; ?>">
                                <?php include("includes/templates/partials/mobile_links.php"); ?>
                            </ul>
                            <!-- Mobile Menu Button -->
                            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header><!-- /header -->

    <!-- | Page Content (Main) | -->
    <main id="page-content" class="<?php if (isset($valign) && $valign) { echo 'valign-wrapper'; } ?>">
        <section class="<?php echo $container_type; ?> <?php if (isset($valign) && $valign) { echo 'valign'; } ?> grey lighten-5 z-depth-3">