<?php

/**
 * Validator class
 */
class Validator
{
    /**
     * Function to validate a username
     * param username - username to validate
     * param min - minimum characters in the username
     * param max - maximum number of characters in the username
     */
    public function validateUsername($username, $min, $max, $remove_whitespace=1)
    {
        if(strlen($username) >= $min && strlen($username) <= $max)
        {
            /**
             * If the remove_whitespace is 1(default is 1) it will trim the string
             */
            if($remove_whitespace == 1)
            {
                $username = trim($username);
            }

            // Sanitizing the username
            $username = stripslashes($username);
            
            // Username cannot contain html tags
            $username = strip_tags($username);

            return $username; // If the validation is success it will return the original username
        }
        else
        {
            // If the validation is failed it will raise an error
            throw new Exception("Username cannot be more than: " . $max . " or less than: " . $min);
        }
    }
}