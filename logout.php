<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/23/17
 * Time: 3:09 PM
 */
session_start();
$session = isset($_SESSION{'user'}) ? $_SESSION{'user'} : '';

$logout = isset($_GET{'logout'}) ? $_GET{'logout'} : '';
if ($logout && $session) {
    session_destroy();
    echo "<script>";
    echo "window.location.replace('index.php');";
    echo "</script>";


}
else
    include_once '404page.php';

