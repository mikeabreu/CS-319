<?php

// Path Constants
defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? NULL : define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'CS-319');
defined('LIB_PATH') ? NULL : define('LIB_PATH', SITE_ROOT . DS . 'includes');
defined('TEMPLATE_PATH') ? NULL : define('TEMPLATE_PATH', LIB_PATH . DS . 'templates');

// Load Configuration
require_once LIB_PATH . DS . 'config.php';

// Load basic functions
require_once LIB_PATH . DS . 'functions' . DS . 'login_functions.inc.php';
require_once LIB_PATH . DS . 'functions' . DS . 'functions.php';

// Load Template Class
require_once LIB_PATH . DS . 'class' . DS . 'Formatter.php';

// Load Core class
require_once LIB_PATH . DS . 'class' . DS . 'Logger.php';
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';
require_once LIB_PATH . DS . 'class' . DS . 'DatabaseObject.php';
require_once LIB_PATH . DS . 'class' . DS . 'Session.php';

// Load database-related classes
require_once LIB_PATH . DS . 'class' . DS . 'User.php';
require_once LIB_PATH . DS . 'class' . DS . 'Search.php';
