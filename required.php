<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/6/17
 * Time: 3:28 AM
 */
/*Interfaces*/
require_once 'class/interface/interface.dbmgmt.php';
require_once 'class/interface/interface.question.php';
require_once 'class/interface/interface.user.php';
/*Abstracts*/
require_once 'abstract/abstract.msg.php';
require_once 'abstract/abstract.error.php';
require_once 'abstract/abstract.log.php';
/*Namespaces*/
//                    require_once 'class/namespace.php';
/*Classes*/
require_once 'class/dbmgmt.php';
require_once 'class/user.php';
require_once 'class/question.php';
require_once 'class/student.php';
require_once 'class/tutor.php';
require_once 'class/error.php';
global $db;
$db = new DbMgmt('localhost', 'armstrong', 'Littleguy007', 'stroom');


$errors = new SiteError();
session_start();

DEFINE('ROOT', '/public/studyroom.com.ng');
DEFINE('PAGE', $_SERVER['PHP_SELF']);
DEFINE('CURRENT_PAGE', ROOT.PAGE);


require_once 'functions.php';
