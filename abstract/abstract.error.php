<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/7/17
 * Time: 3:22 PM
 */
abstract
class FormError extends MsgAbstract
{
    private static $_counts = 0;
    private $_errors;

    /**
     * FormError constructor.
     */
    function __construct()
    {
        $_errors = array();
    }

    public function ErrorExist()
    {
//        If there is an error
        if (count($this->_errors) || sizeof($this->_errors) > 0)
            return true;
        else
            return false;
    }

    public function addErrors($msg, $level = 8, $bold = "Error")
    {
        $this->_errors[self::$_counts]['msg'] = $msg;
        $this->_errors[self::$_counts]['level'] = $level;
        $this->_errors[self::$_counts]['bold_msg'] = $bold;
        ++self::$_counts;
    }

    public function popErrors()
    {

        for ($i = 0; $i < self::$_counts; ++$i) {
            /*Print error message with level*/
            $this->errorMsg($this->_errors{$i}{'msg'}, $this->_errors{$i}{'level'}, $this->_errors{$i}{'bold_msg'});
        }
    }
}