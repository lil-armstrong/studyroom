<?php
require_once 'process.php';


$ask = isset($_POST{'ask'}) ? $_POST{'ask'} : '';
$poraname = isset($_POST{'poraname'}) ? $_POST{'poraname'} : '';
$topic = quoteSlug(isset($_POST{'topic'}) ? $_POST{'topic'} : '');
$dept = isset($_POST{'dept'}) ? $_POST{'dept'} : '';
$msg = quoteSlug(isset($_POST{'msg'}) ? $_POST{'msg'} : '');
$upload = isset($_FILES{'upload'}) ? $_FILES{'upload'} : '';
$timelimit = isset($_POST{'timelimit'}) ? $_POST{'timelimit'} : '';
$timenum = isset($_POST{'timenum'}) ? $_POST{'timenum'} : 1;
$period = isset($_POST{'period'}) ? $_POST{'period'} : '';
$urgent = isset($_POST{'urgent'}) ? $_POST{'urgent'} : '';
$type = isset($_POST{'type'}) ? $_POST{'type'} : '';
$message = 'Error!';


if ($session) {

    if ($ask) {
        require_once 'class/ImageManipulator.php';
        include_once 'header.php';
        if (trim($poraname) === "") {
//        project or assignment name error
            $errors->addErrors('Project or assignment name cannot be empty');
        }
        if (trim($poraname) === "") {
//       topic error
            $errors->addErrors('Topic field cannot be empty');
        }
        if (trim($timelimit) === "" && trim($period) === "") {
//       topic error
            $errors->addErrors('Must specify a timelimit');
        }
        if (!$errors->ErrorExist()) {
            /*period overrides timelimit*/
            if ($period)
                $message = $user->askQuestion($topic, $dept, $msg, $upload, 1, $period, $urgent, $type, $poraname);
            else
                $message = $user->askQuestion($topic, $dept, $msg, $upload, $timenum, $timelimit, $urgent, $type, $poraname);
            header("Location: " . ROOT . "?msg=" . urlencode($message));
        }
    } else {
        $error404 = "You do not have permission to access this page until you ask a question first.";
        include_once '404page.php';
    }
} else
    header("Location: " . ROOT);




