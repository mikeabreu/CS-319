<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class Search extends DatabaseObject
{

    /*
        Attributes
    */
    protected static $table_name = "search";
    protected static $db_fields = array('type_id', '', '', '', '', '', '');
}

?>
