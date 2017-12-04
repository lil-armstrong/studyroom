<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/5/17
 * Time: 11:31 PM
 */

class User extends LogAbstract implements UserInterface
{
//    const table = "members";
    public $messenger;
    protected $_id;
    protected $_conn;
    private $_user_table;
    private $_username;
    private $_email;
    private $_log;
    private $_type;
    private $_help_count;
    private $_feature;
    private $_dept;

    /**
     * @var
     */
    private $pass;

    /**
     * User constructor.
     * @param $conn
     * @param $username
     * @param $pass
     */
    public function __construct($conn)
    {
        $this->_conn = $conn;
    }

    /**
     * @param $username
     * @param $pass
     * @return bool|void
     */
    public function loginUser($username, $pass)
    {
        $this->pass = $pass;
        $this->_username = $username;
        $this->_type = LogAbstract::login($this->_conn, $username, $pass);
        if (($this->_type === "student" || $this->_type === "tutor")) {
//            exit($this->_type);
            $this->createUser($username, $this->_type);
            $this->setID();
            $this->setUserType($this->_type);

            // if($this->_type === "student"){
            //     $this->_feature = new Question($this->_conn);
            // }
            // else{
            //     $this->_feature = new Answer($this->_conn);
            // }
            return true;
        } else
            $this->captureError();
        return false;
    }

    /**
     * @param $username
     */
    public function createUser($username, $type)
    {
        $this->_username = $username;
        $this->setUserType($type);
        $this->setID();
        $this->setUserEmail();
        $this->setHelpCount();
        $this->setDept();
    }

    private function setUserType($type)
    {
//        $query = "SELECT type FROM " . self::table . " WHERE `username`='" . $this->_username . "'";
//        $result = $this->_conn->querySQLi($query, [])->fetch(2);
//        $this->_type = $result{'type'};
        $this->_type = $type;
    }

    /**
     * @param $id
     */
    private function setID()
    {
        $query = "SELECT uid FROM " . $this->_type . " WHERE `username`='" . $this->_username . "'";
        $result = $this->_conn->querySQLi($query, [])->fetch(2);
        $this->_id = trim($result{'uid'}, '0');
    }

    private function setUserEmail()
    {
        $query = "SELECT email FROM " . $this->_type . " WHERE `username`='" . $this->_username . "' ";
        $result = $this->_conn->querySQLi($query, [])->fetch(2);
        $this->_email = $result{'email'};
    }

    private function setHelpCount()
    {
        if ($this->_type === "student")
            $get = "student_help";
        else
            $get = "tutor_help";
        $query = "SELECT total FROM $get WHERE `uid`='" . $this->_id . "'";
        $result = $this->_conn->querySQLi($query, [])->fetch(2);
        $this->_help_count = $result{'total'};
    }

    public function captureError()
    {
        if ($this->_log == LogAbstract::MISMATCH) {
            $this->addErrors('Username or password mismatch', 8, "Login error");
        } elseif ($this->_log == LogAbstract::NONEXISTENT) {
            $this->addErrors('User does not exist');
        }
    }

    /**
     * @param array $details
     * @param $type
     */
    public function registerUser($details = [], $type)
    {
        if ($type === "student") {
            if (is_array($details) && count($details)) {
                extract($details);
                if ($this->_conn->TableExists($type)) {
                    $query = "INSERT INTO " . $type . " (`uid`,`username`,`firstname`,`middlename`,`lastname`,`sex`,`dob`,`marital_status` ,`edulevel` ,`school`,`field`,`city`,`state`,`nationality`,`zipcode`,`pass`,`email`,`phone`,`type`, `create_dt`,`last_login` ) VALUES 
                (NULL,'$username','$firstname','$middlename','$lastname','$sex','$dob','$marital','$edulevel','$school','$field','$city', '$state','$nation','$zipcode','$pass','$email','$phone','$type', NOW(),NULL)";
                }
            } else {
                $query = "INSERT INTO " . $type . " (`uid`,`username`,`firstname`,`middlename`,`lastname`,`sex`,`dob`,`marital_status` ,`edulevel` ,`school`,`field`,`city`,`state`,`nationality`,`zipcode`,`pass`,`email`,`phone`,`type`, `create_dt`,`last_login` ) VALUES 
            ({$details})";
            }
        } else {
            if (is_array($details) && count($details)) {
                extract($details);
                if ($this->_conn->TableExists($type)) {
                    $query = "INSERT INTO " . $type . " (`uid`,`username`,`firstname`,`middlename`,`lastname`,`sex`,`dob`,`marital_status` ,`edulevel` ,`school`,`field`,`city`,`state`,`nationality`,`zipcode`,`pass`,`email`,`phone`,`type`, `create_dt`,`last_login` ) VALUES 
                (NULL,'$username','$firstname','$middlename','$lastname','$sex','$dob','$marital','$edulevel','$school','$field','$city','$state','$nation','$zipcode','$pass','$email','$phone','$type', NOW(),NULL)";
                }
            } else {
                $query = "INSERT INTO " . $type . " (`uid`,`username`,`firstname`,`middlename`,`lastname`,`sex`,`dob`,`marital_status` ,`edulevel` ,`school`,`field`,`city`,`state`,`nationality`,`zipcode`,`pass`,`email`,`phone`,`type`, `create_dt`,`last_login` ) VALUES 
            ({$details})";
            }
        }
//        exit(print_r($query));

        try {
            $this->_conn->querySQLi($query, []);
//            echo MsgAbstract::infoMsg("A $type profile has been successfully created! Thank you for registering with us!");
        } catch (PDOException $e) {
            $this->addErrors($e->getMessage());
        }
    }

    public function removeUser()
    {
        if ($this->userExists()) {
            $query = "DELETE FROM " . $this->_type . " WHERE `uid`='" . $this->_id . "'";
            LogAbstract::logout();
        } else {
            MsgAbstract::errorMsg('Error, user does not exist anymore', 1);
        }
    }

    public function userExists()
    {
        $query = "SELECT uid FROM " . $this->_type . " WHERE `uid`='" . $this->_id . "' AND `type`='" . $this->_type . "'";
        $result = $this->_conn->querySQLi($query, [])->rowCount();
        if ($result)
            return true;
//        exit(print_r($result));
        return false;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getTotalHelp()
    {
        return $this->_help_count;
    }

    public function NotifyTutor($qid, $tutor_id, $duration)
    {

        $query = "INSERT INTO `tutor_msg` (`mid`,`qid`, `tutor_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid','$tutor_id', '$duration', 'notify', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function AlertTutor($qid, $tutor_id, $duration)
    {

        $query = "INSERT INTO `tutor_msg` (`mid`,`qid`, `tutor_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid','$tutor_id', '$duration', 'alert', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function TutorAffirm($qid, $tutor_id, $duration)
    {

        $query = "INSERT INTO `tutor_msg` (`mid`,`qid`, `tutor_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid','$tutor_id', '$duration', 'affirm', NOW())";
        $this->_conn->querySQLi($query);
    }

    public function TutorConfirm($qid, $tutor_id, $duration)
    {

        $query = "INSERT INTO `tutor_msg` (`mid`,`qid`, `tutor_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid','$tutor_id', '$duration', 'confirm', NOW())";
        $this->_conn->querySQLi($query);
    }

    public function NotifyStudent($qid, $student_id, $duration)
    {
//           add to table student_msg
        $query = "INSERT INTO `student_msg` (`mid`,`qid`, `student_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid', '$student_id', '$duration', 'notify', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function AlertStudent($qid, $student_id, $duration)
    {
//           add to table student_msg
        $query = "INSERT INTO `student_msg` (`mid`,`qid`, `student_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid', '$student_id', '$duration', 'alert', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function StudentAffirm($qid, $student_id, $duration)
    {
//           add to table student_msg
        $query = "INSERT INTO `student_msg` (`mid`,`qid`, `student_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid', '$student_id', '$duration', 'affirm', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function StudentConfirm($qid, $student_id, $duration)
    {
//           add to table student_msg
        $query = "INSERT INTO `student_msg` (`mid`,`qid`, `student_id`, `duration`, `level`, `msg_date`) VALUES 
(NULL,'$qid', '$student_id', '$duration', 'confirm', NOW())";
        $this->_conn->querySQLi($query);

    }

    public function getAllPersonalMsg()
    {
        $query = "SELECT * FROM " . $this->getUserType() . "_msg INNER JOIN `questions` WHERE `" . $this->getUserType() . "_id`='" . $this->getID() . "' AND " . $this->getUserType() . "_msg.qid=questions.qid ORDER BY `msg_date` DESC LIMIT 10";
        return $this->_conn->querySQLi($query)->fetchAll(2);
    }

    public function getUserType()
    {
        return $this->_type;
    }

    /**
     * @param $username
     * @param $pass

    /**
     * @return mixed$username
     */
    public function getID()
    {
        return $this->_id;
    }

    public function getAllDeptMsg()
    {
        $query = "SELECT * FROM " . $this->getUserType() . "_dept_msg INNER JOIN `questions` USING (`qid`)  ORDER BY `msg_date` DESC LIMIT 10";
        return $this->_conn->querySQLi($query)->fetchAll(2);
    }

    /**
     * @return array|bool
     */

    public function getUnseenMsgsCount()
    {
        $dept_notify = $this->NotifyByDept($this->getDept(), 1);
        $user_notify = $this->NotifyUser();
        $seen_dept_msgs = $this->getSeenDeptMsgs();
        $seen_personal_msgs = $this->getSeenPersonalMsgs();

        $total_msg = 0;
        if ($dept_notify || $user_notify) {
            foreach ($dept_notify as $all => $item) {
                if (!in_array($item{'mid'}, $seen_dept_msgs)) {
                    $total_msg++;
                }
            }
            foreach ($user_notify as $all => $item) {
                if (!in_array($item{'mid'}, $seen_personal_msgs)) {
                    $total_msg++;
                }
            }
            if ($total_msg) {
                echo "<span class=\"badge notify notify-right\">";
                echo $total_msg;
                echo "</span>";
            }
        }
    }

    /*Prepares the file to be uploaded and check for errors*/

    public function NotifyByDept($dept, $level = "")
    {
        /*Get the current user notifications*/
        $query = "SELECT * FROM " . $this->_type . "_dept_msg WHERE `dept`='$this->_dept' ORDER BY msg_date DESC LIMIT 10 ";
        $result = $this->_conn->querySQLi($query)->fetchAll(2);
//        exit($query);
        return $result;
    }

    /*Uploads files*/

    public function getDept()
    {
        return $this->_dept;
    }

    /*Misc*/

    public function setDept()
    {
        $query = "SELECT `field` FROM " . $this->_type . " WHERE `username`='" . $this->_username . "' ";
//        exit($query);
        $this->_dept = $this->_conn->querySQLi($query, [])->fetch(2){'field'};
    }

    public function NotifyUser()
    {
        /*Get the current user notifications*/
        $query = "SELECT * FROM " . $this->_type . "_msg WHERE `" . $this->_type . "_id`=" . $this->_id . " LIMIT 10";
        $result = $this->_conn->querySQLi($query)->fetchAll(2);
        return $result;
    }

    public function getSeenDeptMsgs()
    {
        /*Find out the number of messages blacklisted or seen*/
        /*Get all user messages*/
        $query = "SELECT * FROM " . $this->getUserType() . "_dept_msg  ORDER BY `msg_date` DESC LIMIT 10";
        $all_dept_msgs = $this->_conn->querySQLi($query)->fetchAll(2);
        $seen_msgs = [];    //Holds all seen messages
        /*seen*/
        foreach ($all_dept_msgs as $dept_msg => $msg) {
            $mid = $msg['mid'];
            $sqli = "SELECT * FROM " . $this->getUserType() . "_dept_msg_seen WHERE `mid`='$mid' AND `uid`='" . $this->getID() . "'";
            $seen = $this->_conn->querySQLi($sqli)->fetch(2);
            if ($seen)
                $seen_msgs[] = $mid;
        }
        /*Output*/
        return $seen_msgs;
    }


    /*Notifies the user as per individual*/

    public function getSeenPersonalMsgs()
    {
        /*Find out the number of messages blacklisted or seen*/
        /*Get all user messages*/
        $query = "SELECT * FROM " . $this->getUserType() . "_msg  ORDER BY `msg_date` DESC LIMIT 10";
        $all_dept_msgs = $this->_conn->querySQLi($query)->fetchAll(2);
        $seen_msgs = [];    //Holds all seen messages
        /*get all seen*/
        foreach ($all_dept_msgs as $dept_msg => $msg) {
            $mid = $msg['mid'];
            $sqli = "SELECT * FROM " . $this->getUserType() . "_msg_seen WHERE `mid`='$mid' AND `uid`='" . $this->getID() . "'";
            $seen = $this->_conn->querySQLi($sqli)->fetch(2);
            if ($seen)
                $seen_msgs[] = $mid;
        }
        /*Output*/
        return $seen_msgs;
    }

    /*Notifies the user as per department*/

    /**
     * @param $type
     * @return bool
     */
    public function fileUploader($type = "misc", $proj)
    {
        $upload = isset($_FILES{'upload'}) ? $_FILES{'upload'} : '';
        $fsize = $upload{'size'};

        $proj = date('m_y-') . 'u' . $this->_id . '-' . strtolower(slug($proj));

//exit();
//If there is a file to upload
        if (boolval($upload{'size'}{0})) {

            $allowedExts = [
                'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text', 'image/pjpeg', 'image/jpeg', 'image/gif', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            $imgExts = ["jpg", "png", "JPG", "jpeg", "JPEG", "gif"]; //allowed Extensions

            $fname = $upload{"name"};
            $ftmp_name = $upload{'tmp_name'};
            $ftype = $upload{'type'};
            $ferror = $upload{'error'};
            $link_home = "<br/><a onclick='window.history.back()'><i class='fa fa-home'>&nbsp;</i>Return</a>";


//
            if (is_array($upload)) {

                for ($i = 0; $i < sizeof($fsize); ++$i) {
                    $crntfname = $fname{$i} ;
                    $crntftype = $ftype{$i};
                    $fstrlen = strlen($crntfname); //Gets the file string length
                    $crntfloc = $ftmp_name{$i};     /*Get tmp location og file*/
                    $crntferr = $ferror{$i};    /*Get file error status*/
                    $crntfsize = $fsize{$i};    /*Get file size status*/
                    $fext = substr($crntfname, ($fstrlen - 4));  // get extention string
                    $checkfext = substr($fext, 1);      //For checking file extension
                    $onlyfname = substr($crntfname, 0, ($fstrlen - 4));
                    $onlyfname = strtolower(substr($onlyfname, 0,35));
                    /*If part of supported extensions*/
                    if (in_array($crntftype, $allowedExts) && $crntferr < 524288) {
                        /*If any errors at all*/

                        if ($crntferr > 0) {
                            /*Toggle thru errors*/
                            switch ($crntferr) {
                                case 1:
                                    $this->addErrors("The $checkfext file: '" . $crntfname . " failed to upload due to upload timeout!" . $link_home);
                                    break;
                                case 2:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload! Check file size. (max: 512KB)" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                case 3:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload due to partial download" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                case 4:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload! No file was uploaded" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                case 6:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload! Non-existent temporary folder" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                case 7:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload! Unable to write to disk" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                case 8:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> failed to upload! File upload stopped!" . $link_home, $crntferr, "$checkfext upload error");
                                    break;
                                default:
                                    $this->addErrors("<i>'" . $crntfname . "'</i> <br/>failed to upload due to System Error!" . $link_home, "10", "$checkfext upload error");
                                    break;
                            }

                            /*Cleans file if it exists in tmp folder*/
                            if (file_exists($crntfloc) && is_file($crntfloc)) {
                                unlink($crntfloc);
                            }
                            $this->popErrors();
                            exit();
                        } else {

                            /*No Error*/
                            // make file name in lower case
                            //replace space with "_"
                            $finalfname = strtolower(slug($onlyfname));
//Check file extension

                            /*If it is an image*/
                            if (in_array($checkfext, $imgExts)) {

                                $extdir = "img" . DIRECTORY_SEPARATOR;
                                $upload_dir = 'assets/uploads/' . $type . '/' . $extdir . $proj . DIRECTORY_SEPARATOR;
                                $upload_dir_file = $upload_dir . $finalfname . $fext;

                                $query = "INSERT INTO `user_uploads`(`fid`, `filename`, `dir`, `uploader`,  `filetype`, `upload_type`, `upload_date`, `projtname`) 
VALUES (NULL,'$finalfname','$upload_dir_file', '" . $this->_id . "','$crntftype', '$type',NOW(), '$proj')";

                                //Resizing Picture
                                if ($manipulator = new ImageManipulator($crntfloc)) {
                                    // resizing to required image
                                    $newImage = $manipulator->resample(570, 500, TRUE); //False Gives Specific height and width

                                    if ($this->_conn->querySQLi($query)) {
                                        $manipulator->save($upload_dir_file);
                                    } else {
                                        $this->addErrors('Unable to save file ' . ($finalfname) . $link_home);
                                        $this->popErrors();
                                        exit();
                                    }

                                }
                            } else {

                                //if not an image file
                                $extdir = $checkfext . DIRECTORY_SEPARATOR;
                                $upload_dir = 'assets/uploads/' . $type . '/' . $proj . DIRECTORY_SEPARATOR . $extdir;
                                $upload_dir_file = $upload_dir . $finalfname . $fext;

                                $query = "INSERT INTO `user_uploads`(`fid`, `filename`, `dir`, `uploader`,  `filetype`, `upload_type`, `upload_date`, `projtname`) 
VALUES (NULL,'$finalfname','$upload_dir_file', '" . $this->_id . "','$crntftype', '$type',NOW(), '$proj')";

                                /*If dir does not exist*/
                                if (!is_dir($upload_dir)) {
                                    /*Attempt creating directory*/
                                    if (!mkdir($upload_dir, 0755, true)) {
                                        /*else throw an error*/
                                        throw new RuntimeException('Error creating directory ' . $upload_dir);
                                    }
                                }

                                /*If not an image file*/
                                if (!(move_uploaded_file($crntfloc, $upload_dir_file) && $this->_conn->querySQLi($query))) {
                                    $this->addErrors('Unable to save file!'.$link_home);
                                    $this->popErrors();
                                    exit();
                                }

                            }
                        }
                    } else {
                        $this->addErrors("<i>'" . $crntfname . "'</i> is an unsupported format.".$link_home);
                        $this->popErrors();
                        exit();
                    }
                }

            }
        }
        return $proj;
    }

    public function displayColumn($col)
    {
        /*Gets the 2D array*/
        $details = $this->getColumn($col);
        print_r($details);
//        echo "<strong><br/>Reading from table: ".self::table."</strong><hr>";
//        echo "<table class='table table-striped table-bordered table-hover table-full-width'>
//                        <thead>
//                            <tr>";
//        foreach ($details as $detail) {
//            echo "<th>";
//            echo $detail;
//            echo "</th>";
//        }
//        echo "</tr>";
//        echo "</thead>";
//        echo "<tbody>";
//
//        for ($j = 0; $j < sizeof($result); ++$j) {
//            echo "<tr>";
//            for ($k = 0; $k < sizeof($result[$j]); ++$k) {
//                echo "<td>" . $result[$j][$k] . "</td>";
//            }
//            echo "</tr>";
//        }
//        echo "</tbody>
//                </table>";
    }

    public function getColumn($col)
    {
        $args = $col;
        $condition = 'WHERE `uid` = ' . $this->_id;
        return $this->_conn->readCol(self::table, $args, $condition, 2);
    }

    public function logStatus()
    {
        if ($this->_id) {
            return TRUE;
        } else
            return FALSE;
    }

}