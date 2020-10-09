<?php
require_once 'appUser.php';
require_once 'adminDBConnecton.php';

/**
 * Administrator
 */
class AdminUser
{
    use adminDBConnecton;
    use appUser;

    /**
     * set up connection on object creation
     */
    function __construct(){
        $this->conn();
    }

    /**
     * Set up connection to the database
     */
    function connect(){
        if($this->connection != null){
            var_dump($this->connection);
            
        }else{
            $this->conn();
            var_dump($this->connection);
        }
    }
    
    /**
     * close database connection
     */
    function closeConnection(){
        $this->connection->close();
        $this->connection = null;
    }
}
