<?php

class db {
    private $host = 'localhost';
    private $port = 3307;
    private $user = 'root';
    private $pass = 'usbw';
    private $db = 'anketa';
    private $connection;
    private static $_instance;

    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
        $mysqli = $this->getConnection();
        $sql='
          CREATE TABLE IF NOT EXISTS `answerss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_bin NOT NULL,
  `correct` int(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `q_id` (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0      
                
       
                ';
        $mysqli->query($sql);
        
    }

    public function getConnection() {
        return $this->connection;
    }

}
?>
