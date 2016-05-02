<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class Game extends DatabaseObject
{
    /*
        Attributes
    */
    protected static $table_name = "games";
    protected static $db_fields = array('id', 'platform', 'genre', 'game_name', 'description', 'image');

    public $id;
    public $platform;
    public $genre;
    public $game_name;
    public $description;
    public $image;

    # Find User By Username
    public static function find_by_name($game_name = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE game_name = '{$game_name}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    # Find Game By Game Name
    public static function find_all_by_pattern($pattern = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE game_name LIKE '%{$pattern}%'");
        return !empty($result_array) ? $result_array : false;
    }
}
