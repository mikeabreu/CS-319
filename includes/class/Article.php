<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class Article extends DatabaseObject
{
    /*
        Attributes
    */
    protected static $table_name = "news";
    protected static $db_fields = array('id', 'subject', 'content', 'author', 'datetime');

    public $id;
    public $subject;
    public $content;
    public $author;
    public $datetime;

    # Find Article By Subject
    public static function find_by_name($subject = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE subject = '{$subject}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

}
