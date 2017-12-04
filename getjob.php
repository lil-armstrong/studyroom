<?php
require_once 'process.php';
$job_id = isset($_GET{'jb'}) ? $_GET{'jb'} : '';
$by = isset($_GET{'by'}) ? $_GET{'by'} : '';
if ($session) {
    if ($switch === "student") {
        if ($job_id && $by) {
            $query = "SELECT triggered_by FROM tutor_dept_msg WHERE mid='$job_id'";
            $result = $db->querySQLi($query)->fetch(2);
            if (md5($result{'triggered_by'}) === $by) {
                $query = "SELECT * FROM questions WHERE by_who=" . $result{'triggered_by'};
                $result = $db->querySQLi($query)->fetch(2);
                $uploads = $db->getUpload($result{'upload'})->fetch(2);
                $result{'upload'} = $uploads;
                /*notify the questioner that a tutor has accepted the job */
            }
            else
                include_once('404page.php');
            ?>
            <?php
        }
        else
            include_once('404page.php');
    }
}
else
include_once('404page.php');

