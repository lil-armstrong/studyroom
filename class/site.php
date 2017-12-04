<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/15/17
 * Time: 3:47 PM
 */

class Site
{

    private $_conn;
    private $handleErrors;

    /**
     * Site constructor.
     * @param $conn
     */

    public function __construct($conn)
    {
        $this->_conn = $conn;
    }


}