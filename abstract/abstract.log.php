<?php

abstract /**
 * abstract.msg
 */
class LogAbstract extends FormError
{
    const SUCCESS = 0;
    const MISMATCH = -1;
    const NONEXISTENT = -2;

    public function login($conn, $username, $pass)
    {
        $query = "SELECT * FROM student WHERE `username`='{$username}' OR `email`='{$username}' ";
        $result = $conn->querySQLi($query, [])->rowCount();
        if ($result) {
//User exist
//            Confirm username and password
            $query = "SELECT uid, username, type FROM student WHERE( `username`='{$username}' OR `email`='{$username}') AND `pass`='" . $pass . "'";
            $result = $conn->querySQLi($query, [])->fetch(2);
            if ($result) {
                /*Set user session*/
                $_SESSION{'user'} = $result{'username'};
                $_SESSION{'type'} = $result{'type'};
                $query = "UPDATE student SET `last_login`=NOW() WHERE( `username`='{$username}' OR `email`='{$username}') AND `pass`='" . $pass . "'";
                $result = $conn->querySQLi($query, []);
                return "student";   //returns the student type
            } else {
                /*User pass or name is wrong*/
                return self::MISMATCH;
            }

        } else {
            $query = "SELECT * FROM tutor WHERE `username`='{$username}' OR `email`='{$username}'";
            $result = $conn->querySQLi($query, [])->rowCount();
            if ($result) {
//User exist
//                Confirm username and password
                $query = "SELECT uid, username, type FROM tutor WHERE( `username`='{$username}' OR `email`='{$username}') AND `pass`='" . $pass . "'";
                $result = $conn->querySQLi($query, [])->fetch(2);
                if ($result) {
                    /*Set user session*/
                    $_SESSION{'user'} = $result{'username'};
                    $_SESSION{'type'} = $result{'type'};
                    $query = "UPDATE tutor SET `last_login`=NOW() WHERE( `username`='{$username}' OR `email`='{$username}') AND `pass`='" . $pass . "'";
                    $result = $conn->querySQLi($query, []);
                    return "tutor";   //returns the student type

                } else {
                    /*User pass or name is wrong*/
                    return self::MISMATCH;
                }
            } else {
                /*User does not exist*/
                return self::NONEXISTENT;
            }
        }
    }

    public function logout()
    {
        $session = isset($_SESSION{'user'}) ? $_SESSION{'user'} : '';
        if ($session) {
            session_destroy();
            session_start();
        }
    }
}