<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/5/17
 * Time: 11:31 PM
 */

class Student extends User
{
    const switch_to = 'tutor';
    const profile = 'student';
    public $_questioner;

    public function __construct($db)
    {
        $this->_conn = $db;
        $this->_questioner = new Question($db);
    }

    public function returnSwitch()
    {
        return self::switch_to;
    }

    /*Stores messages for tutors*/

    public function profile()
    {
        return self::profile;
    }

    public function askQuestion($topic, $dept, $msg, $upload = [], $timenum = 1, $period, $urgent = (1 | 0), $type, $proj)
    {
        $expires = $this->_questioner->questionExpires($timenum, $period);
        /*Uploads the file to appropriate folder*/
        $upload = $this->fileUploader($type, $proj);
        /*Inserts into the questions database*/
        $query = "INSERT INTO questions (`qid`, `topic`, `message`, `projtname`, `urgent`, `by_who`, `type`, `status`, `starts`, `expires`, `match_tutor`, `ask_date`,  `answer_date`) VALUES (NULL, '$topic', '$msg', '$upload', '$urgent', '" . $this->_id . "', '$type', 'pending', NULL,'$expires' , NULL,NOW(), NULL )";

        if ($result = $this->_conn->querySQLi($query, [])) {

            /*Sends message to the related department*/
            /*get the ID of the most recently inserted question*/
            $query = "SELECT qid FROM questions WHERE `by_who`='" . $this->_id . "' ORDER BY qid DESC LIMIT 1";
            $get_qid = $this->_conn->querySQLi($query, [])->fetch(2){'qid'};

            $this->NotifyTutorDept($this->_id, $get_qid, $this->getDept(), $expires, "affirm");
            return "Question successfully added";
        }
        return "Question could not be added";
    }

    public function NotifyTutorDept($uid, $qid, $dept, $duration, $level = "notify")
    {
//           add to table tutor_msg
        $query = "INSERT INTO `" . self::switch_to . "_dept_msg` (`mid`,`qid`, `dept`,`duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid', '" . $this->getDept() . "', '$duration', '$level', NOW())";
        $this->_conn->querySQLi($query);
    }


    public function getAllAssignments()
    {
        $query = "SELECT `qid`, `topic`, `message`, `projtname`, `urgent`, `by_who`, `type`, `status`, `starts`,  DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires  , `match_tutor`, DATE_FORMAT(`ask_date`, '%r') AS ask_date, `answer_date` FROM questions WHERE (`by_who`='" . $this->getID() . "' AND `type`='assignment')";
        return $result = $this->_conn->querySQLi($query, [])->fetchAll(2);
    }

    public function getAllProjects()
    {
        $query = "SELECT `qid`, `topic`, `message`, `projtname`, `urgent`, `by_who`, `type`, `status`, `starts`,  DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires  , `match_tutor`, DATE_FORMAT(`ask_date`, '%r') AS ask_date, `answer_date` FROM questions WHERE `by_who`='" . $this->_id . "' AND `type`='project'";
        return $result = $this->_conn->querySQLi($query, [])->fetchAll(2);
    }
}