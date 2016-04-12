<?php

## Auto load
function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

## Include Layout Template
function include_layout_template($template = "")
{
    include(SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template);
}

## 	Redirect Function
function redirect_to($location = NULL)
{
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

##	Strip Zeros from Date
function strip_zeross_from_date($marked_string = "")
{
    // First Remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);

    // Second Remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

##	Output Message
function output_message($message = "")
{
    if (!empty($message)) {
        if (is_array($message)) {
            $output = "";
            foreach ($message as $line) {
                $output .= "<p class\"message\">" . $line . "</p>";
            }
        } else {
            return "<p class=\"message\">{$message}</p>";
        }
    } else {
        return "";
    }
}