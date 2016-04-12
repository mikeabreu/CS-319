<?php

class Logger
{
    ## 	Attributes
    public $logfile;

    ## 	Constructor
    function __construct()
    {
        $this->logfile = SITE_ROOT . DS . 'logs' . DS . 'logs.txt';
    }

    ## 	Methods

    # 	Log Action
    public function log_action($action, $message = "")
    {
        $time = time();
        $formated_message = strftime("%Y-%m-%d %H:%M:%S", $time);
        $formated_message .= ' | ' . $action . ': ' . $message;
        if ($this->check_log($this->logfile)) {
            $formated_message = "\n" . $formated_message;
            $this->append($this->logfile, $formated_message);
        } else {
            $this->create_log($this->logfile, $formated_message);
        }
    }

    # 	Create a fresh file (deletes current files) and writes inital message
    public function create_log($filepath_and_name, $message = "")
    {
        file_put_contents($filepath_and_name, $message);
    }

    #	Delete the log file
    public function delete_log()
    {
        unlink($this->logfile);
        $username = $_SESSION['username'];
        $this->log_action("Log file Created", "The log file was cleared by '{$username}'");
    }

    # 	Append to an existing file, expects message to include newline characters
    private function append($file, $message)
    {
        if ($handle = fopen($file, 'a+')) {
            fwrite($handle, $message);
            fclose($handle);
        } else {
            $_SESSION['message'] = "Could not append/write to file: " . $file;
        }
    }

    # 	Check if file exists
    public function check_log()
    {
        if (file_exists($this->logfile)) {
            if (is_readable($this->logfile)) {
                if (is_writeable($this->logfile)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    #	Read the contents of the log file and puts into array
    public function read_log()
    {
        $lines = array();
        if ($handle = fopen($this->logfile, 'r')) {
            while (!feof($handle)) {
                $lines[] .= fgets($handle);
            }
            return $lines;
        }
    }

    public function split_lines_to_assoc($lines)
    {
        $container = array();
        $new_lines = array();
        $lines = $this->read_log($this->logfile);
        foreach ($lines as $line) {
            $tmp_lines = explode(' ', $line);
            $size_of_tmp = count($tmp_lines);
            $new_lines['Date'] = $tmp_lines[0];
            $new_lines['Time'] = $tmp_lines[1];
            if (strpos($tmp_lines[3], ':')) {
                $new_lines['Action'] = $tmp_lines[3];
                $new_lines['Message'] = "";
                for ($i = 4; $i < $size_of_tmp; $i++) {
                    $new_lines['Message'] .= $tmp_lines[$i] . ' ';
                }
            } else if (strpos($tmp_lines[4], ':')) {
                $new_lines['Action'] = $tmp_lines[3] . ' ' . $tmp_lines[4];
                $new_lines['Message'] = "";
                for ($i = 5; $i < $size_of_tmp; $i++) {
                    $new_lines['Message'] .= $tmp_lines[$i] . ' ';
                }
            } else if (strpos($tmp_lines[5], ':')) {
                $new_lines['Action'] = $tmp_lines[3] . ' ' . $tmp_lines[4] . ' ' . $tmp_lines[5];
                $new_lines['Message'] = "";
                for ($i = 6; $i < $size_of_tmp; $i++) {
                    $new_lines['Message'] .= $tmp_lines[$i] . ' ';
                }
            } else {
                $new_lines['Action'] = $tmp_lines[3] . ' ' . $tmp_lines[4] . ' ' . $tmp_lines[5] . ' ' . $tmp_lines[6];
                $new_lines['Message'] = "";
                for ($i = 7; $i < $size_of_tmp; $i++) {
                    $new_lines['Message'] .= $tmp_lines[$i] . ' ';
                }
            }
            $container[] = $new_lines;
        }
        return $container;
    }
}

$log = new Logger();