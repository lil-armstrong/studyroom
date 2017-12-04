<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/3/17
 * Time: 8:01 PM
 * interface.QuestionInterface.php
 */
interface QuestionInterface
{


    function pickQuestion($id);

    function getQuestion();

    function getUpload();


    function getAnswer();

    function WhoAsked();

    function WhoAnswer();

    function getPrice();

    function storeQuestion();

    function notify();

}