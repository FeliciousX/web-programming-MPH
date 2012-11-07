<?php

class DBConfiguration {

    // Local Server
    private $dbHost = "localhost";
    private $dbUserName = "root";
    private $dbPassword = "";
    private $dbName = "SLDRBS";
    
   // 000 Webhost Server
    
   // private $dbHost = "mysql5.000webhost.com";
   // private $dbUserName = "a7668852_max";
   // private $dbPassword = "ITclub2012";
   // private $dbName = "a7668852_sldrbs";

   // private $dbHost = "mysql4.000webhost.com";
   // private $dbUserName = "a2646259_max";
   // private $dbPassword = "ITclub2012";
   // private $dbName = "a2646259_sldrbs";

     

    public function getDbHost() {
        return $this->dbHost;
    }

    public function getDbUserName() {
        return $this->dbUserName;
    }

    public function getDbPassword() {
        return $this->dbPassword;
    }

    public function getDbName() {
        return $this->dbName;
    }

}

?>