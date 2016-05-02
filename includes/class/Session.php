<?php

class Session
{
    ## 	Attributes
    public $user_id;
    public $username;
    public $user_type;
    private $logged_in;


    ## 	Constructor
    function __construct()
    {
        session_start();
        $_SESSION['message'] = "";
        $this->check_login();
        if ($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }


    ## 	Methods
    # Check if user is logged in
    public function is_logged_in()
    {
        return $this->logged_in;
    }

    # Check if user is an admin
    public function is_admin() {
        if ($_SESSION['user_type'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    # Login the user to the session.
    public function login($user)
    {
        global $log;
        // Database should find user based on username/password
        if ($user) {
            // Success
            $_SESSION['user_id'] = $user->id;
            $this->user_id = $user->id;
            $_SESSION['username'] = $user->username;
            $this->username = $user->username;
            $_SESSION['user_type'] = $user->user_type_id;
            $this->user_type = $user->user_type_id;
            $log->log_action('LOGIN', ("'" . $user->username . "' has logged in with priv level of " . $this->user_type));
            $this->logged_in = true;
        } else {
            // Fail
            $log->log_action('LOGIN ATTEMPT', ("'" . $user->username . "' has tried to log in."));
        }
    }

    # Logout the user from the session.
    public function logout()
    {
        global $log;
        $log->log_action('LOGOUT', ("'" . $_SESSION['username'] . "' has logged out."));
        unset($_SESSION['user_id']);
        unset($this->user_id);
        unset($_SESSION['username']);
        unset($this->username);
        unset($_SESSION['user_type']);
        unset($this->user_type);
        $this->logged_in = false;
    }

    # Check if session is logged in.
    private function check_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
}

$session = new Session();
