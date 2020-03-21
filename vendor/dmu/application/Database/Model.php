<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/19
 * Time: 1:32 AM
 */

namespace Application\Database;


class Model extends Connection
{
    public const EQUAL = "=";
    public const GREATERTHAN = ">";
    public const LESSTHAN = "<";
    public const GREATERTHANEQUAL = ">=";
    public const LESSTHANEQUAL = "<=";
    public const LOGIC_AND = "AND";
    public const LOGIC_OR = "OR";
    public const ASC = "ASC";
    public const DESC = "DESC";

    private $_whereStatemet;
    private $_orderByStatement;
    private $_limitStatement;

    private $table;
    public function __construct()
    {
        parent::__construct();
        $table_name = explode("\\", get_class($this));
        $this->table = strtolower($table_name[count($table_name)-1]);
    }

    public function __call($method,$args){
        if($method == "find"){
            $row=  $this->findByCol("id", $args[0]);
            if($row == null)
                return null;
            return (count($row))?$row[0]: null;
        }elseif(preg_match("/findBy[a-b]*/", $method)){
            return $this->findByCol(strtolower(substr($method, 6)), $args[0]);
        }
        switch ($method) {
            case "where":
                switch(count($args)){
                    case 2:
                        return $this->whereLogic($args[0], self::EQUAL, $args[1], self::LOGIC_AND);
                        break;
                    case 3:
                        return $this->whereLogic($args[0], $args[1],$args[2]);
                        break;
                }
                break;
            case "orWhere":
                switch(count($args)){
                    case 2:
                        return $this->whereLogic($args[0], self::EQUAL, $args[1], self::LOGIC_OR);
                        break;
                    case 3:
                        return $this->whereLogic($args[0], $args[1],$args[2], self::LOGIC_OR);
                        break;
                }
                break;
            case "orderBy":
                switch(count($args)){
                    case 1:
                        return $this->orderBy($args[0], self::ASC);
                        break;
                }
        }
    }

    public function whereLogic($col, $op , $val, $logic){
        $this->_whereStatemet .= ($this->_whereStatemet)?" $logic ":"";
        $this->_whereStatemet .= "`$col`". " ".$op. "'$val' ";
        return $this;
    }

    public function orderBy($col, $order){
        $this->_orderByStatement .= ($this->_orderByStatement)?" , ":"";
        $this->_orderByStatement .= "`$col`" . " ". $order;
        return $this;
    }

    public function get(){

            $sql = "SELECT * FROM $this->table";
            $sql .= $this->_whereStatemet?" WHERE $this->_whereStatemet": "";
            $sql .= $this->_orderByStatement? " ORDER BY $this->_orderByStatement":"";
            return $this->execQuery($sql);

    }

    public function take($limit){
        $this->_limitStatement .= $limit;
    }

    public function first(){
        $this->take(1);
        return count($this->get())?$this->get()[0]: null;
    }
    public function findByCol($col, $val){
        $this->where($col, $val);
        return $this->get();
    }
    public function insert($row){
        $values = self::split($row);
        $cols = implode(",", $values->key);
        $vals = "'".implode("','",$values->val )."'";
        $sql = "INSERT INTO $this->table($cols) VALUES ($vals)";
        $insert = parent::query($sql);

        return $this->find($this->insert_id);
    }
    public function update($row){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $sql = "UPDATE  $this->table SET ";
        $updates = [];
        foreach($row as $col => $val){
            array_push($updates, "`$col`"."='$val'");
        }
        $sql .= implode(" , ", $updates)." ";
        $sql .= ($this->_whereStatemet)?"WHERE ($this->_whereStatemet) ": "";
        parent::prepare($sql)->execute();
        return $this;
    }
    public function delete(){
        $sql = "DELETE FROM $table" . ($this->_whereStatemet)?"WHERE ($this->_whereStatemet)": "";
        parent::prepare($sql)->execute();
        return $this;
    }

    private static function split($arr){
        $splilted = (object)["key"=>[], "val"=>[]];
        foreach($arr as $key=>$val){
            array_push($splilted->key, $key);
            array_push($splilted->val, $val);
        }
        return $splilted;
    }

    private function execQuery($sql){
        $statement = parent::query($sql);
     //   $statement->execute();

        $rows = [];
//        foreach($statement->fetch_array() as $col=>$val){
//            $row = json_decode(json_encode($val));
//            array_push($rows, $row);
//        }
        while ($row = $statement->fetch_assoc()) {
            $row = json_decode(json_encode($row));
            array_push($rows, $row);
        }
        $statement->free();
        return $rows;
    }

    public function search($key){
        $sql = "SELECT * FROM $this->table WHERE MATCH (title, isbn, author) AGAINST ('$key' IN NATURAL LANGUAGE MODE)";

        return $this->execQuery($sql);
    }
}