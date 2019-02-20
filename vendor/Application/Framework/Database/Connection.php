<?php 

namespace Application\Framework\Database; 

class Connection extends \mysqli {
    private $_db_config;

    public function __construct()
    {
        $this->_db_config = require APPLICATION_ROOT."/config/database.config.php";
//        try{
//            parent::__construct($this->_db_config["db_connection"].
//                            ":host=".$this->_db_config["db_host"].
//                            ";dbname=".$this->_db_config["db_name"].
//                            ";db_port=".$this->_db_config["db_port"],
//                            $this->_db_config["db_username"],
//                            $this->_db_config["db_password"]
//                        );
//            parent::setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//        }catch(PDOException $e){
//            //die("Dbconection fialdl".$e.getMessage());
//        }
        parent::__construct($this->_db_config["db_host"],
            $this->_db_config["db_username"],
            $this->_db_config["db_password"],
            $this->_db_config["db_name"],
            $this->_db_config["db_port"]);

    }

    public function __destruct()
    {
        parent::close();
    }

}