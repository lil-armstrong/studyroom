<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/22/17
 * Time: 9:06 PM
 */
require_once 'process.php';

$msg_encrypt = isset($_GET{'msg_id'}) ? $_GET{'msg_id'} : null;
/* md5($msgs{'triggered_by'}) . md5("view") */
$get_msg_id = substr($msg_encrypt, 0, 1);
$get_crypt_data = substr($msg_encrypt, 1);
if ($session) {
    if ($user->getUserType() === "tutor") {
        require_once 'header.php';
        if ($msg_encrypt) {
            /*Confirm the request*/
            $query = "SELECT * FROM tutor_dept_msg WHERE mid='" . substr($get_msg_id, 0, 1) . "'";
            $result_confirm = $db->querySQLi($query)->fetch(2);
            /*gets the message id from the tutor dept messages*/
            /*Confirm GET request*/

            if ($result_confirm{'mid'} . md5('affirm') === $msg_encrypt) {
                $query = "SELECT *, DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires FROM questions WHERE  `qid`='" . $result_confirm{'qid'} . "'";
                $result = $db->querySQLi($query)->fetch(2);
                //add to the tutor task table (individual)
                if ($user->addTask($result_confirm{'qid'})) {
                    $msg = "You have successfully accepted a task!";
                    //add to the tutor message table (individual)
                    $user->TutorAffirm($result_confirm{'qid'}, $user->getID(), $result{'expires'});

                    $msg = "You have been matched with a tutor. The " . $result{'type'} . " \"" . ucfirst(substr($result{'projtname'}, 9)) . "\" has been accepted.! You can proceed to make payments ";
                    //add to the student message table
                    $user->StudentAffirm($result_confirm{'qid'}, $result{'by_who'}, $result{'expires'});
                    //delete from tutor_dept_msg table
                    $query = "DELETE FROM tutor_dept_msg WHERE mid='" .$get_msg_id. "'";
                    $db->querySQLi($query);
                    $msg = "Task was successfully added!";
                    header("Location: " . ROOT . "?msg=" . urlencode($msg));
                } else {
                    $msg = "Error! Could not add task";
                    header("Location: " . ROOT . "?msg=" . urlencode($msg));
                }
                include_once 'inc-js.php';
                echo "</html>";

            } else {
                include_once('404page.php');
                echo "\n";
            }

        }
    }
} else
    include_once('404page.php');

//To accept a project or assignment

//Update the questions table (match_tutor)


