<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/19
 * Time: 1:42 AM
 */

namespace Application\Database;

use Exception;

class Table extends Connection
{
    public const NULL = "NULL";
    public const NOT_NULL = "NOT NULL";
    public const DEFAULT_INT_SIZE = 11;
    public const DEFAULT_STRING_SIZE = 255;
    public const DEFAULT_PRIMARY_KEY_NAME = "id";
    public const DEFAULT_UPDATE_TIME = "CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";

    private $_create_table_statement;
    private $table;
    private $cols;

    public function __construct()
    {
        parent::__construct();
        $table_name = explode("\\", get_class($this));
        $this->table = strtolower($table_name[count($table_name)-1]);
        $this->table = str_replace('migration', "", $this->table); 
        $this->_create_table_statement = "CREATE TABLE $this->table ";
        $this->cols = [];
    }
    public function schema(){

    }
    public function increment($col = self::DEFAULT_PRIMARY_KEY_NAME){
        $primary_key = "PRIMARY KEY ($col)";
        $col = "`$col` INT(11) NOT NULL AUTO_INCREMENT";

        array_push($this->cols, $col);
        array_push($this->cols, $primary_key);
    }
    public function  int($col, $nullable = self::NOT_NULL, $size = self::DEFAULT_INT_SIZE, $default = null){
        $col = "`$col` INT($size) $nullable ";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }
    public function string($col,$nullable = self::NOT_NULL,  $size= self::DEFAULT_STRING_SIZE, $default = null){
        $col = "`$col` VARCHAR($size) $nullable";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }
    public function boolean($col, $default = null){
        $col = "`$col` int(1) $nullable";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }
    public function decimal($col,$nullable = self::NOT_NULL,  $size= self::DEFAULT_INT_SIZE, $default = null){
        $col = "`$col` decimal($size) $nullable";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }
    public function date($col,$nullable = self::NOT_NULL, $default = ""){
        $col = "`$col` DATE $nullable";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }
    public function datetime($col,$nullable = self::NOT_NULL, $default = "CURRENT_TIMESTAMP"){
        $col = "`$col` DATETIME $nullable";
        $col .= ($default)? " DEFAULT $default ": "";
        array_push($this->cols, $col);
    }

    public function create(){
        try{
            $sql =  "$this->_create_table_statement (";
            $sql .= implode(",", $this->cols). " )  ENGINE = InnoDB";

            $prepare = parent::prepare($sql); 
            if($prepare)
                $prepare->execute();
        
            return $this->table; 
        }catch(Exception $e){
            echo $e->getMessage(); 
        }
    }


}