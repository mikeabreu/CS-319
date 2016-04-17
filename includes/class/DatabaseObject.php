<?php
require_once LIB_PATH . DS . 'class' . DS . 'MySQLDatabase.php';

class DatabaseObject
{

    /*
        Common Database Methods
    */
    protected static $table_name;
    protected static $db_fields;

    #	Save
    #	Creates a user if doesn't exist. Otherwise updates the user.
    public static function save($object)
    {
        //	A new record won't have an id yet.
        return (isset($object->id)) ? $object->update() : $object->create();
    }

    #	Create a user
    public function create()
    {
        global $db;
        global $log;
        #	Don't forget your SQL syntax and good habits:
        #		-	INSERT INTO table (key, key) VALUES ('value', 'value')
        #		-	single-quotes around all values
        #		-	escape all values to prevent SQL injection.
        $attributes = $this->sanitized_attributes();

        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        $log_message = "Table: " . static::$table_name;

        if ($db->query($sql)) {
            $this->id = $db->insert_id();
            $log_message .= ", id='" . $this->id . "', by username: " . $_SESSION['username'];
            $log->log_action("CREATE SUCCESS", $log_message);
            $log->log_action("SQL Query (SUCCESS)", $sql);
            return true;
        } else {
            $log_message .= ", by username: " . $_SESSION['username'];
            $log->log_action("CREATE FAILED", $log_message);
            $log->log_action("SQL Query (Failure)", $sql);
            return false;
        }
    }

    #	Update information for a user
    public function update()
    {
        global $db;
        global $log;
        #	Don't forget your SQL syntax and good habits:
        #		-	UPDATE table SET key='value', key='value' WHERE condition
        #		-	single-quotes around all values
        #		-	escape all values to prevent SQL injection.
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id = " . $db->escape_value($this->id);
        $db->query($sql);

        $log_message = "Table: " . static::$table_name;
        $log_message .= ", id='" . $this->id . "', by username: " . $_SESSION['username'];

        if ($db->affected_rows() == 1) {
            $log->log_action("UPDATE SUCCESS", $log_message);
            return true;
        } else {
            $log->log_action("UPDATE FAILED", $log_message);
            return false;
        }
    }

    #	Delete a user
    public static function delete($object)
    {
        global $db;
        global $log;
        #	Don't forget your SQL syntax and good habits:
        #		-	DELETE FROM table WHERE condition LIMIT 1
        #		-	single-quotes around all values
        #		-	escape all values to prevent SQL injection.
        $sql = "DELETE FROM " . static::$table_name . " WHERE id = ";
        $sql .= $db->escape_value($object->id);
        $sql .= " LIMIT 1";
        $db->query($sql);
        $log_message = "Table: " . static::$table_name;
        $log_message .= ", id='" . $object->id . "', by username: " . $_SESSION['username'];
        if ($db->affected_rows() == 1) {
            $log->log_action("DELETE SUCCESS", $log_message);
            return true;
        } else {
            $log->log_action("DELETE FAILED", $log_message);
            return false;
        }
    }

    # Find all
    public static function find_all()
    {
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }

    # Find User By ID
    public static function find_by_id($id = 0)
    {
        global $db;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    # Find By SQL
    public static function find_by_sql($sql = "")
    {
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();
        while ($row = $db->fetch_assoc($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    # Instantiate the user (Populate all fields from query)
    private static function instantiate($record)
    {
        $class_name = get_called_class();
        $object = new $class_name;

        # More dynamic, short-form approach:
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;

        # Simple, Long-form approach:
        /*
            $object->id 		= $record['id'];
            $object->username 	= $record['username'];
            $object->password 	= $record['password'];
            $object->first_name = $record['first_name'];
            $object->last_name 	= $record['last_name'];
        */
    }

    # Check if attribute exists within user
    private function has_attribute($attribute)
    {
        # get_object_vars returns an associative array with all attributes
        # (incl. private ones!) as the keys and their current values as the value
        $object_vars = get_object_vars($this);
        # We don't care about the value, we just want to know if they key exists
        # Will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    # 	Raw Attributes
    private function attributes()
    {
        #	Return an array of attribute keys and their values
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        echo 'Attributes: ' . print_r($attributes);
        return $attributes;
    }

    # 	Sanitized Attributes
    private function sanitized_attributes()
    {
        global $db;
        $clean_attributes = array();
        //	Sanitize the values before submitting
        //	Note: does not alter the actualy value of each attribute
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $db->escape_value($value);
        }
        echo 'Clean Attributes: ' . print_r($clean_attributes);
        return $clean_attributes;
    }
}