<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/3/17
 * Time: 7:52 PM
 */


class Question implements QuestionInterface
{
    private $_answer;
    private $_question;
    private $_price;
    private $_urgent;
    private $_student;
    private $_tutor;
    private $_topic;
    private $_msg;
    private $_duration;
    private $_uploaded = [];
    private $_dept;
    private $_conn;
    private $_qid;
    private $purchases;

    public function __construct($conn)
    {
        /*Set the db connection parameters*/
        $this->_conn = $conn;
    }


    public function pickQuestion($qid)
    {
        if ($this->QuestionExist($qid)) {
            $this->_qid = $qid;
        } else {
            echo "The selected question does not exist";
        }
    }

    private function QuestionExist($qid = '')
    {
        if (empty($qid))
            $query = "SELECT qid FROM questions WHERE qid = '$qid'";
        else
            $query = "SELECT qid FROM questions WHERE qid = '" . $this->_qid . "' ";
        $result = $this->_conn->querySQLi($query, [])->rowCount();
        if ($result)
            return true;
        return false;
    }

    public function getQuestion()
    {
        if ($this->QuestionExist()) {
            $query = "SELECT topic, message FROM questions WHERE qid ='" . $this->_qid . "' ";

            $result = $this->_conn->querySQLi($query, []);
            if ($result) {
                return $result;
            }
        }
        return 0;
    }


    public function questionExpires($timenum = 1, $period)
    {
        if (preg_match('/^([1]*[0-2]*|([0]*[1-9]))\/([1-2]*[0-9]*|[3][0,1]|([0][1-9])){1,2}\/\d{4}$/', $period))
            $expires = $this->convertPeriod($period);
        else {
            $add_day = 0;
            $add_week = 0;
            $add_month = 0;
            $add_year = 0;
            switch ($period) {
                case 'day':
                    $add_day = $timenum;
                    break;
                case 'week':
                    $add_week = $timenum;
                    break;
                case 'month':
                    $add_month = $timenum;
                    break;
                case 'year':
                    $add_year = $timenum;
                    break;
            }
            $expires = $this->convertLimit($add_day, $add_week, $add_month, $add_year);
            //     echo $add_day;
            //     echo $add_week;
            //     echo $period;
            //     echo $add_month;
            //     echo $timenum;
        }
        // echo $expires;
        return $expires;
    }

    public function convertPeriod($format)
    {

        $format = explode("/", $format);
        $month = $format{0};
        $day = $format{1};
        $year = $format{2};
        $now = new DateTime();

        if (checkdate($month, $day, $year)) {
            $now->setDate($year, $month, $day);
            return (date('Y/m/d 00:00:00', $now->getTimestamp()));
        }
        return false;
    }

    public function convertLimit($add_day = 0, $add_week = 0, $add_month = 0, $add_year = 0)
    {

        $now = new DateTime();
//        $hours_per_day = 24;
//        $days_per_week = 7;
//        $weeks_per_month = getdate();
//        $months_per_year = 12;

        $cur_day = date('d');
        $cur_month = date('m');
        $cur_year = date('Y');

        $total_day = ($add_week) ? (7 * $add_week) : ($add_day);
        $calc_day = $cur_day + $total_day;
        $calc_month = $cur_month + $add_month;
        $calc_year = $cur_year + $add_year;
        /*Set the expiry date*/
        $now->setDate($calc_year, $calc_month, $calc_day);

        return (date('Y/m/d 00:00:00', $now->getTimestamp()));
    }

    public function getAnswer()
    {
        // TODO: Implement getAnswer() method.
    }

    public function WhoAsked()
    {
        // TODO: Implement getStudent() method.
    }

    public function WhoAnswer()
    {
        // TODO: Implement getTutor() method.
    }

    public function getPrice()
    {
        // TODO: Implement getPrice() method.

    }

    public function getUpload()
    {
        // TODO: Implement getUpload() method.
    }

    public function storeQuestion()
    {

    }

    public function notify()
    {

    }

    private function setAnswer()
    {

    }

    private function setPrice()
    {

    }

    private function setUpload()
    {

    }

    private function offsetPrice()
    {

    }

}