<?php
class db {
    /**
     *  DB config
     */
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
        mysqli_set_charset( $this->connection,"utf8");
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
        
       /**
        * Init tables
        */
        $sql='
        CREATE TABLE IF NOT EXISTS `answers` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `q_id` int(11) NOT NULL,
       `answer` text COLLATE utf8mb4_bin NOT NULL,
       `correct` int(1) DEFAULT 0,
        PRIMARY KEY (`id`),
        KEY `q_id` (`q_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0      
        ';
        $this->connection->query($sql);
        
        $sql='
        CREATE TABLE IF NOT EXISTS `peoples` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `form_id` int(11) NOT NULL,
        `name` text COLLATE utf8mb4_bin NOT NULL,
        `start` datetime NOT NULL,
        `finish` datetime NOT NULL,
         PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0      
        ';
        $this->connection->query($sql);
        
        $sql='
        CREATE TABLE IF NOT EXISTS `people_answ` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `people_id` int(10) NOT NULL,
        `answer_id` int(10) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0   
        ';
        $this->connection->query($sql);
        
        $sql='
        CREATE TABLE IF NOT EXISTS `questionnaire` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` text COLLATE utf8mb4_bin NOT NULL,
        `active` int(1) NOT NULL DEFAULT 1,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0  
        ';
        $this->connection->query($sql);
        
        $sql='
        CREATE TABLE IF NOT EXISTS `questions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name_id` int(11) NOT NULL,
        `questions` text COLLATE utf8mb4_bin NOT NULL,
        `order` int(2) NOT NULL,
         PRIMARY KEY (`id`),
         KEY `name_id` (`name_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=0 
        ';
        $this->connection->query($sql);
        
        $this->connection->query("ALTER TABLE `answers` ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`)");
        $this->connection->query("ALTER TABLE `questions` ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`name_id`) REFERENCES `questionnaire` (`id`)");
        
    }

    public function getConnection() {
        return $this->connection;
    }

}
?>
