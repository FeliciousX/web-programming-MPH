<?php

class DBConfiguration {

    // Local Server
    private $dbHost = "localhost";
    private $dbUserName = "root";
    private $dbPassword = "";
    private $dbName = "SLDRBS";

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