<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/15/17
 * Time: 5:56 PM
 */

class Answer
{
    private $_conn;
    /**
     * Answer constructor.
     */
    public function __construct($conn)
    {
        /*Set the db connection parameters*/
        $this->_conn = $conn;
    }

    public function bidQuestion($qid){
//        TODO: Request to answer question
    }
}