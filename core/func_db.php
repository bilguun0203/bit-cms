<?php

class func_db {

    private $db;

    public function construct($DB_con){
        $this->db=$DB_con;
    }

    // ------- Table functions ----------
    // Create Table
    public function createTable($name, $columns){
        $sql = "CREATE TABLE " . $table . " (";
        $i = 0;
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $sql .= $col . " " . $value . ",";
            }
            else if($i == $cols-1) {
                $sql .= $col . " " . $value . ")";
            }
        }
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    // Alter Table
    public function alterTable($table, $method, $column, $datatype=""){
        $sql = "ALTER TABLE " . $table . " ";
        if(strtolower($method) == "add" && $datatype!=""){
            $sql .= " ADD " . $column . " " . $datatype;
        }
        else if(strtolower($method) == "modify" && $datatype != ""){
            $sql .= " MODIFY COLUMN ";
        }
        else if(strtolower($method) == "drop"){
            $sql .= " DROP COLUMN " . $column;
        }
        else return 0;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    // Truncate Table
    public function truncateTable($table){
        $sql = "TRUNCATE TABLE " . $table;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    // Drop Table
    public function dropTable($table){
        $sql = "DROP TABLE " . $table;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }

    // ---------- Data functions ------------
    // Select
    public function select($table, $columns="*", $where="", $order=""){
        $sql = "SELECT ";
        if($columns == "*"){
            $sql .= "*";
        }
        else {
            $cols = count($columns);
            for($i = 0; $i < $cols; $i++){
                if($i < $cols-1){
                    $sql .= $columns[$i] . ", ";
                }
                else if($i == $cols-1) {
                    $sql .= $columns[$i] . " ";
                }
            }
        }
        $sql = "FROM " . $table . " WHERE " . $where;
        if($order == "ASC" || $order == "DESC"){
            $sql .= " ORDER BY " . $order;
        }
        try {
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                return $result;
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    // Insert
    public function insert($table, $columns){
        $column_list = "(";
        $value_list = "(";
        $cols = count($columns);
        $i = 0;
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $column_list .= $col . ", ";
                $value_list .= $value . ", ";
            }
            else if($i == $cols-1) {
                $column_list .= $col . ")";
                $value_list .= $value . ")";
            }
        }
        $sql = "INSERT INTO " . $table . " " . $column_list " VALUES " . $value_list;
        try {
            $this->db->exec($sql);
            return 1;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    // Update
    public function update($table, $columns, $where){
        $sql = "UPDATE " . $table . " SET ";
        $values = "";
        $i = 0;
        foreach ($columns as $col => $value) {
            if($i < $cols-1){
                $values .= $col . "='" . $value . "',";
            }
            else if($i == $cols-1) {
                $values .= $col . "='" . $value . "'";
            }
        }
        $sql .= " WHERE " . $where;
        try {
            if($this->db->query($sql) === TRUE){
                return 1;
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
    }
    // Delete
    public function delete($table, $where){
        $sql = "DELETE FROM " . $table . " WHERE " . $where;
        try {
            if($this->db->query($sql) === TRUE){
                return 1;
            }
            else return 0;
        }
        catch(PDOException $e){
            echo "ERROR >> SQL: " $sql . "; Message:" . $e->getMessage();
            return 0;
        }
    }
}
