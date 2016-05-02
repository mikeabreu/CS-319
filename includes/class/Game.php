<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class Game extends DatabaseObject
{
    /*
        Attributes
    */
    protected static $table_name = "games";
    protected static $db_fields = array('id', 'user_id', 'platform', 'genre', 'game_name');

    public $id;
    public $user_id;
    public $platform;
    public $genre;
    public $game_name;

    # Find User By Username
    public static function find_by_name($game_name = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE game_name = '{$game_name}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
}
