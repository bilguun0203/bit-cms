<?php

class func_db {

    private $db;

    public function __construct($DB_con){
        $this->db = $DB_con;
    }

    // ------- Table functions ----------
    /*      Create Table
        CREATE TABLE $table ($columns)
    */
    public function createTable($table, $columns, $primary=""){
        $sql = "CREATE TABLE " . $table . " (";
        $i = 0;
        $cols = count($columns);
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $sql .= "`" . $col . "` " . $value . ",";
            }
            else if($i == $cols-1) {
                if($primary!=""){
                    $sql .=  "`" . $col . "` " . $value . ",PRIMARY KEY (" . $primary . "))";
                }
                else {
                    $sql .=  "`" . $col . "` " . $value . ") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                }
            }
            $i++;
        }
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      ALTER Table
        $method == "add" >> ALTER TABLE $table ADD $column $datatype
        $method == "modify" >> ALTER TABLE $table MODIFY COLUMN $column $datatype
        $method == "drop" >> ALTER TABLE $table DROP COLUMN $column
    */
    public function alterTable($table, $method, $column, $datatype=""){
        $sql = "ALTER TABLE " . $table . " ";
        if(strtolower($method) == "add" && $datatype!=""){
            $sql .= " ADD `" . $column . "` " . $datatype;
        }
        else if(strtolower($method) == "modify" && $datatype != ""){
            $sql .= " MODIFY COLUMN `" . $column . "` " . $datatype;
        }
        else if(strtolower($method) == "drop"){
            $sql .= " DROP COLUMN `" . $column . "`";
        }
        else return 0;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Truncate Table
        TRUNCATE TABLE $table
    */
    public function truncateTable($table){
        $sql = "TRUNCATE TABLE `" . $table . "`";
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Drop Table
        DROP TABLE $table
    */
    public function dropTable($table){
        $sql = "DROP TABLE `" . $table . "`";
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }

    // ---------- Data functions ------------
    /*      Select row(s)
        SELECT $columns FROM $table WHERE $where ORDER BY $order
    */
    public function select($table, $columns="*", $where="1", $order="", $additions=""){
        $sql = "SELECT ";
        if($columns == "*"){
            $sql .= "*";
        }
        else {
            $sql .= $columns;
        }
        $sql .= " FROM " . $table . " WHERE " . $where . " ";
        if($order!="") {
            $sql .= "ORDER BY " . $order . " ";
        }
        $sql .= $additions;
        try {
            $result = $this->db->query($sql);
            if($result->rowCount() > 0){
                if($result->rowCount()==1){
                    return $result->fetch();
                }
                return $result->fetchAll();
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Insert row
        INSERT INTO $table $column_list VALUES $value_list
    */
    public function insert($table, $columns){
        $column_list = "(";
        $value_list = "(";
        $cols = count($columns);
        $i = 0;
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $column_list .= "`" . $col . "`, ";
                $value_list .= "'" . $value . "', ";
            }
            else if($i == $cols-1) {
                $column_list .= "`" . $col . "`)";
                $value_list .= "'" . $value . "')";
            }
            $i++;
        }
        $sql = "INSERT INTO " . $table . " " . $column_list . " VALUES " . $value_list;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Update row
        UPDATE $table SET $values WHERE $where
    */
    public function update($table, $columns, $where){
        $sql = "UPDATE " . $table . " SET ";
        $values = "";
        $i = 0;
        $cols = count($columns);
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $values .= "`" . $col . "`='" . $value . "',";
            }
            else if($i == $cols-1) {
                $values .= "`" . $col . "`='" . $value . "'";
            }
            $i++;
        }
        $sql .= $values . " WHERE " . $where;
        try {
            if($this->db->query($sql) == TRUE){
                return 1;
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Delete row
        DELETE FROM $table WHERE $where
    */
    public function delete($table, $where){
        $sql = "DELETE FROM `" . $table . "` WHERE " . $where;
        try {
            if($this->db->query($sql) == TRUE){
                return 1;
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }
    /*      Check table exists
        SELECT * FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = '$table' LIMIT 1
    */
    public function checkTable($dbname, $table){
        $sql = "SELECT * FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = '$table' LIMIT 1;";
        try {
            $result = $this->db->query($sql);
            if($result->rowCount() == 0){
                return 0;
            }
            else return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
        }
    }

    public function checkAllTable($dbname,$prefix){
        $tables = array($prefix."posts",$prefix."pages",$prefix."users",$prefix."options",$prefix."menu");
        $table_not_found = array();
        $i=0;
        foreach ($tables as $table){
            $sql = "SELECT * FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = '$table' LIMIT 1;";
            try {
                $result = $this->db->query($sql);
                if($result->rowCount() == 0){
                    $table_not_found[$i] = $table;
                    $i++;
                }
//                else return 1;
            }
            catch(PDOException $e){
                echo "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
                return "ERROR >> SQL: " . $sql . "; Message:" . $e->getMessage();
            }
        }
        if($i==0)
            return 1;
        else
            return $table_not_found;
    }
}
