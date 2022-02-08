<?php

/**
 * 
 * How to use this small library
 * 
 * 1. Create an instance
 *      $validator = new Validator();
 * 
 * 2. Use any validator inside a try catch block
 *      try {
 *         $username = $validator->validateUsername(<name>, <min>, <max>);
 * 
 *          <DO ANYTHING WHAT YOU WANT WITH $username>
 *      } catch(Exception $e) {
 *          echo $e;
 *      }
 * 
 */

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

    /**
     * Function to validate passwords
     */
    public function validatePassword($password, $min, $max)
    {
        /**
         * This will trime and remove all unnecessory characters in the string
         */
        $password = trim($password);
        $password = stripslashes($password);
        $password = strip_tags($password);

        if(strlen($password) >= $min && strlen($password) <= $max)
        {
            return $password;
        }
        else
        {
            throw new Exception("Password cannot be more than: " . $max . " or less than: " . $min);
        }
    }

    /**
     * Function to validate emails
     */
    public function validateEmail($email)
    {
        $email = trim($email);

        /**
         * If the given email is not validated this will raise an exception
         */
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return $email;
        }
        else
        {
            throw new Exception("Not validated email");
        }
    }

    /**
     * This will validate phone numbers
     * param number - a string
     */
    public function validatePhone($number, $chars)
    {
        if(strlen($number) === $chars)
        {
            return $number;
        }
        else
        {
            throw new Exception("Not validated phone number");
        }
    }
}