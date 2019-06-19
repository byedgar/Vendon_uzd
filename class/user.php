<?php

class user {
    private $name;
    private $cur_question;
    private $count_questions;
    private $date;
    private $test;
    
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function user($name, $date, $test, $cur_question) {
        if(!$this->getName()){
            $this->name = $name;
            $this->date = $date;
            $this->test = $test;
            $this->cur_question = 1;
        }
    }
   
    
    
    function getName() {
        return $this->name;
    }

    function getCur_question() {
        return $this->cur_question;
    }

    function getCount_questions() {
        return $this->count_questions;
    }

    function getDate() {
        return $this->date;
    }

    function getTest() {
        return $this->test;
    }



}
?>