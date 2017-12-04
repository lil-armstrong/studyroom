<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/5/17
 * Time: 11:31 PM
 */

class Tutor extends User
{
    const switch_to = 'student';

    public $answerer;


    public function returnSwitch()
    {
        return self::switch_to;
    }

    public function getAllAssignments()
    {
//        $query = "SELECT `tid`, `topic`, `message`, `upload`, `urgent`, `by_who`, `type`, `status`, `starts`,  DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires  , `match_tutor`, DATE_FORMAT(`ask_date`, '%r') AS ask_date, `answer_date` FROM task WHERE `by_who`='".$this->_id."' AND `type`='assignment'";
//        return $result = $this->_conn->querySQLi($query, [])->fetchAll(2);
    }

    public function getAllProjects()
    {
        $query = "SELECT `qid`, `topic`, `message`, `projtname`, `urgent`, `by_who`, `type`, `status`, `starts`,  DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires  , `match_tutor`, DATE_FORMAT(`ask_date`, '%r') AS ask_date, `answer_date` FROM questions WHERE `match_tutor`='" . $this->_id . "' AND `type`='project'";
        return $result = $this->_conn->querySQLi($query, [])->fetchAll(2);
    }

    /*Notifies the user as per individual*/

    public function NotifyStudentDept($uid, $subject = "no subject", $msg, $duration, $type = "assignment", $level = "notify")
    {
        $msg = quoteSlug($msg);
//           add to table tutor_msg
        $query = "INSERT INTO `" . self::switch_to . "_dept_msg` (`mid`, `subject`, `message`, `type`, `triggered_by`,`dept`,`duration`, `level`, `msg_date`) VALUES 
(NULL,'$subject', '$msg', '$type', '" . $this->getID() . "', '" . $this->getDept() . "', '$duration', '$level', NOW())";
        $this->_conn->querySQLi($query);
    }

    public function addTask($qid){
        $query = "INSERT INTO task (`tid`, `qid`, `accept_date`) VALUES (NULL, '$qid', NOW())";
        return $this->_conn->querySQLi($query);
    }

    public function authorizeTask(){
        $query = "UPDATE task SET  `start_date`=NOW()";
        return $this->_conn->querySQLi($query);
    }

}