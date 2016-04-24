<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class User extends DatabaseObject
{
    /*
        Attributes
    */
    protected static $table_name = "users";
    protected static $db_fields = array('type_id', 'username', 'first_name', 'last_name', 'email', 'pass', 'registration_date');

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $email;
    public $type;

    /*
        Methods
    */
    # Return full name of user
    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    # Authenticate user
    public static function authenticate($username = "", $input_password = "")
    {
        global $db;
        $username = $db->escape_value($username);
        $input_password = $db->escape_value($input_password);
        $user = self::find_by_username($username);
        if (isset($user) && is_object($user)) {
            if (self::check_password($input_password, $user->password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    ## Check Password
    public static function check_password($password, $existing_hash)
    {
        $hash = crypt($password, $existing_hash);
        $hash = substr($hash, 0, 40);
        if ($hash === $existing_hash) {
            return true;
        }
        return false;
    }

    ## Encrypt Password
    public static function password_encrypt($password)
    {
        $hash_format = "$2y$10$";        // Tells PHP to use Blowfish with a "cost" of 10
        $salt_length = 22;        // Blowfish salts should be 22-characters or more
        $salt = self::generate_salt($salt_length);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password, $format_and_salt);
        return $hash;
    }

    ## Generate Random Salt
    private function generate_salt($length)
    {
        ## Not 100% unique, not 100% random, but good enough for a salt
        ## MD5 returns 32 characters
        $unique_random_string = md5(uniqid(mt_rand(), true));

        # Valid characters for a salt are [a-zA-Z0-9./]
        $base64_string = base64_encode($unique_random_string);

        # But not '+' which is valild in base64 encoding
        $modified_base64_string = str_replace('+', '.', $base64_string);

        # Truncate string to the correct length
        $salt = substr($modified_base64_string, 0, $length);

        return $salt;

    }

    # Find User By Username
    public static function find_by_username($username = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE username = '{$username}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
}
