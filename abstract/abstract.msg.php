<?php

abstract /**
 * abstract.msg
 */
class MsgAbstract
{

    public function errorMsg($msg, $level = 2, $bold_msg = 'Error Message')
    {
        switch ($level) {
            case '2':
            case '8':
            case '512':
            case '1024':
                $bold_msg = "Notice: " . $bold_msg;
                echo "<div class=\"alert alert-warning text-center not-rounded\">
				<button data-dismiss=\"alert\" class=\"close\"> &times; </button>
				<i class=\"fa fa-info-circle\"></i> <strong>{$bold_msg}!</strong><br/>{$msg}.</div>";
                break;

            default:
                $bold_msg = "Fatal: " . $bold_msg;
                echo "<div class=\"alert alert-danger text-center not-rounded\">
				<i class=\"fa fancybox-error\"></i> <strong>{$bold_msg}</strong><br/>{$msg}.</div>";
                break;
        }
        return FALSE;
    }

    public function successMsg($msg, $bold_msg = 'Success')
    {
        return "<div class=\"alert alert-success text-center not-rounded\">
				<button data-dismiss=\"alert\" class=\"close\"> &times; </button>
				<i class=\"fa fa-check-circle\"></i> <strong>{$bold_msg}</strong><br/>{$msg}.</div>";
    }

    public function infoMsg($msg, $bold_msg = 'Success')
    {
        return  "<div class=\"alert alert-info text-center not-rounded\">
				<button data-dismiss=\"alert\" class=\"close\"> &times; </button>
				<i class=\"fa fa-info-circle\"></i> <strong>{$bold_msg}</strong><br/>{$msg}.</div>";
    }


}