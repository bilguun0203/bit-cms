<?php

class func_db {

    private $db;

    public function construct($DB_con){
        $this->db=$DB_con;
    }

    // Table functions
    public function createTable($name, $columns){}
    public function alterTable($table, $method, $column, $datatype=""){}
    public function truncateTable($table){}
    public function dropTable($table){}

    // Data functions
    public function select($table, $columns, $where="", $order="ASC"){}
    public function insert($table, $columns){}
    public function update($table, $columns, $where){}
    public function delete($table, $where){}
}