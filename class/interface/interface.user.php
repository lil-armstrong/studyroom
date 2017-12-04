<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/5/17
 * Time: 10:02 PM
 */

interface UserInterface
{
    /**
     * @param $details
     * @return mixed
     */
    function registerUser($details, $type);

    /**
     * @return mixed
     */
    function removeUser();

    /**
     * @return mixed
     */
    function userExists();

    function getUsername();

    function createUser($username, $type);

    function getColumn($col);

    function displayColumn($col);

    function logStatus();

    function getID();

    /**
     * @param $username
     * @param $pass
     * @return mixed
     */
    function loginUser($username, $pass);

}