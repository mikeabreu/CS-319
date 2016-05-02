<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class Tag extends DatabaseObject
{
    /*
        Attributes
    */
    protected static $table_name = "tags";
    protected static $db_fields = array('id', 'game_id', 'tag_name');

    public $id;
    public $game_id;
    public $tag_name;

    # Find Game By Game Name
    public static function find_by_name($tag_name = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE tag_name = '{$tag_name}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    # Find Tags By Game ID
    public static function find_all_by_game_id($id = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE game_id = '{$id}' LIMIT 1");
        return !empty($result_array) ? $result_array : false;
    }
}
