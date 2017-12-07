<?php

//interface.dbmgmt.php

interface DbMgmtInterface
{

    /**
     * @param $table
     * @param $args
     * @return mixed
     */
    function readTable($table, $args);

    /**
     * @param $table
     * @param $args
     * @param $changes
     * @return mixed
     */
    function updateTable($table, $args, $changes);

    /**
     * @param $table
     * @return mixed
     */
    public function dropTable($table);

    /**
     * @param $query
     * @param $args
     * @return mixed
     */
    function querySQLi($query, $args);

    function TableExists($table);

}