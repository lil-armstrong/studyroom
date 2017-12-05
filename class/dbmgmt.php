<?php

//class.dbmgmt.php
class DbMgmt extends MsgAbstract implements DbMgmtInterface
{
    protected static $_conn;
    protected static $_db_name;
    private static $_host;
    private static $_user;
    private static $_pass;

    public function __construct($host, $user, $pass, $db_name)
    {
        #Set connection params
        self::$_host = $host;
        self::$_user = $user;
        self::$_pass = $pass;
        self::$_db_name = $db_name;
        self::$_conn = new PDO("pgsql:host=" . self::$_host . ";dbname=" . self::$_db_name, self::$_user, self::$_pass);
        #Attempt database connection
        $this->dbConnect();

    }

    private function dbConnect()
    {
        if ($this->checkConnect(0))
            return true;
        return false;

    }

    public function checkConnect($public = (0 | 1))
    {
        try {
            // set the PDO error mode to exception
            self::$_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$_conn->exec("SET CHARACTER SET utf8");

            $msg = "Database connection successful";
            if ($public)
                MsgAbstract::successMsg($msg);
        } catch (PDOException $e) {
            if ($public)
                MsgAbstract::errorMsg($e->getMessage(), $e->getCode(), 'Faulty database connection');
        }
    }

    public function __destruct()
    {
        self::$_conn = null; /*Close connection*/
    }

    public function dropTable($table)
    {
        $query = "DROP TABLE $table";
        $result = $this->querySQLi($query, []);
        //TODO: deassociate any object with the table
    }

    /**
     * @param $query
     * @param array $args
     * @return mixed
     */
    public function querySQLi($query, $args = [])
    {
        try {
            $query = self::$_conn->prepare($query);
            $query->execute($args);
        } catch (PDOException $e) {
            MsgAbstract::errorMsg($e->getMessage(), 1, 'Faulty database connection');
            die();
        }
        return $query;
    }

    public function readTable($table, $args = '*', $opt = [])
    {
        $fields = implode(',', $args);
        $query = "SELECT $fields FROM $table";
        $result = $this->querySQLi($query, [])->fetchAll(3);
        $num_opt = count($opt);

        $msg = "The fields provided are fewer than expected.\nSubstituting missing columns";
        $num_args = count($args);
        $num_opts = count($opt);

        if (is_array($args)) {
            if (!($num_args == $num_opts)) {
                if ((count($args) > count($opt))) {
                    $this->errorMsg($msg);
                    for ($i = 1; $i <= (count($args) - count($opt)) + 1; ++$i) {
                        array_push($opt, 'cat(' . $i . ')');
                    }
                } elseif ((count($args) < count($opt))) {
                    $this->errorMsg($msg);
                    for ($i = 0; $i <= (count($result) - count($args)); ++$i) {
                        array_pop($opt);
                    }
                }
            }

        } elseif (!(count($result) == count($opt))) {
            $this->errorMsg($msg);
        }
        echo "<strong><br/>Reading from table: $table</strong><hr>";
        echo "<table class='table table-striped table-bordered table-hover table-full-width'>
                        <thead>
                            <tr>";
        foreach ($opt as $field) {
            echo "<th>";
            echo $field;
            echo "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for ($j = 0; $j < sizeof($result); ++$j) {
            echo "<tr>";
            for ($k = 0; $k < sizeof($result[$j]); ++$k) {
                echo "<td>" . $result[$j][$k] . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }

    /**
     * @param $table
     * @param int $args
     * @param array $changes
     * @param string $where
     * @return bool
     */
    public function updateTable($table, $args = ('*' | []), $changes = [], $where = "1")
    {
        $num_changes = count($changes);
        $num_args = sizeof($args);
        $msg = "Could not update. Check your SQL syntax again!";
        $query = "UPDATE $table SET ";

        if (!is_array($args)) {
            if (is_array($changes)) {
                if (($num_changes > 1)) {
                    $this->errorMsg($msg);
                    MsgAbstract::errorMsg("#Args does not match #changes to be made");
                    die();
                } else {
                    $query .= $args . " = '" . $changes[0] . "' ";
                }
            } else {
                $query .= $args . " = \"$changes\" ";
            }

        } else {
            if (!is_array($changes)) {
                foreach ($args as $arg) {
                    $query .= $arg . " = \"$changes\", ";
                }
            } elseif ($num_args == $num_changes) {
                for ($i = 0; $i < $num_changes; ++$i) {
                    $query .= $args[$i] . " = \"" . $changes[$i] . "\"";
                    if ($i < ($num_changes - 1)) {
                        $query .= ", ";
                    }
                    $query .= ($this->_id != null) ? "OR  `fid`='$this->_id'" : "";
                }
            } else {
                $this->errorMsg($msg);
                die();
            }
        }
        $query .= " WHERE $where";
//        var_dump($query);

        $result = $this->querySQLi($query, []);
        if ($result)
            return TRUE;
        return FALSE;

    }

    public function readCol($table, $args = '*', $condition, $rType = (2 | 3 | 4))
    {
        if (is_array($args)) {
            $args = implode(',', $args);
        }
        $query = "SELECT $args FROM $table WHERE $condition";
        return $this->querySQLi($this, $args)->fetchAll($rType);
    }

    public function TableExists($table)
    {
        $query = "SHOW TABLES";
        $tables = $this->querySQLi($query, [])->fetchAll(2);
//        echo "<pre>";
//        print_r($tables);
//        echo "</pre>";
        foreach ($tables as $results => $result)
            foreach ($result as $num => $name)
                if (in_array("$table", $result))
                    return true;
        return false;
    }

    public function getDbName()
    {
        return self::$_db_name;
    }

    public function getUpload($upload_id)
    {
        $query = "SELECT * FROM user_uploads WHERE `projtname`='$upload_id'";
        return $this->querySQLi($query);
    }
}