<?php

class questions {

   
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
/**
 * Empty constructor
 */
    function questions() {
       
    }
    /**
     * Function Get all active tests
     * @param type $mysqli - Mysqli connection
     * @return html option values
     */
    function select_names( $mysqli ){
    $options = '';
    $result = $mysqli->query("
        SELECT q.id, q.name,count(qq.name_id)
        FROM questionnaire q
        INNER JOIN questions qq on qq.name_id = q.id
        WHERE q.active =1
        group by q.id,q.name");
    while($showtablerow = mysqli_fetch_array($result))
	{
            $options.='<option value="'. $showtablerow[0].'">'. $showtablerow[1].' ('. $showtablerow[2].' questions)</option>';
	}
        return $options;
    }	
    /**
     * Function count all questions in test
     * @param type $mysqli - Mysqli connection
     * @param type $test_id - test form id
     * @return int
     */
    function count_steps($mysqli, $test_id){
		$result	= $mysqli->query("SELECT MAX( q.order ) FROM questions q INNER JOIN answers a ON a.q_id = q.id WHERE q.name_id =$test_id");
		while($count = mysqli_fetch_array($result))
		{$steps =$count[0];}
		 return $steps;
    }
    
    /**
     * Function count all questions in test by user_id
     * @param type $mysqli - Mysqli connection
     * @param type $user_id - User id from DB
     * @return int
     */
    function count_steps_from_uid($mysqli, $user_id){
		$result	= $mysqli->query("SELECT MAX( q.order ) FROM questions q INNER JOIN answers a ON a.q_id = q.id WHERE q.name_id =(SELECT form_id from peoples WHERE id=$user_id)");
		while($count = mysqli_fetch_array($result))
		{$steps =$count[0];}
		 return $steps;
    }
    
    /**
     * Function get question name by order id
     * @param type $mysqli - Mysqli connection
     * @param type $test_id - test form id
     * @return String 
     */
    function question_name($mysqli, $test_id, $order_id){
		$sql = "
		SELECT q.questions
		FROM questions q
		WHERE q.name_id =$test_id
		AND q.order =$order_id
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
                {$nos =$data[0];}
		if($nos){ return $nos;}
		
	}
     /**
     * Function get all answers
     * @param type $mysqli - Mysqli connection
     * @param type $form_id - form id from DB
     * @param type $qid - question id
     * @return String 
     */
    	function question_answers($mysqli, $form_id, $qid){
		$sql = "
		SELECT a.id, a.answer FROM questions q
				INNER JOIN answers a ON a.q_id = q.id
				WHERE q.name_id = $form_id
				AND q.order = $qid
				ORDER BY RAND()
		";
		$result	= $mysqli->query($sql);
		$data='';
		$skaits=0;
		while($count = mysqli_fetch_array($result))
		{
		 $required='';
		 $skaits++;
		 IF($skaits==1){ $required="required";}
		 $id =$count[0];
		 $answer=$count[1];
		 $data.='<li class="list"><input class="hidden" '.$required.' id="radio'.$id.'"name="atbilde" type="radio" value="'.$id.'" /><label for="radio'.$id.'">'.$answer.'</label> </li>';
		}
		 return $data;
		
	}
        
        /**
         * Function count correct answers by user_id
         * @param type $mysqli - Mysqli connection
         * @param type $uid
         * @return int
         */
        function get_correct_answers($mysqli, $uid){
		
		$sql = "
		SELECT count(*) FROM peoples p
		INNER JOIN people_answ an on p.id = an.people_id
		INNER JOIN answers a on a.id = an.answer_id
		WHERE p.id=$uid and a.correct=1
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
		{$skaits =$data[0];}
		if($skaits){ return $skaits;}else{return 0;}	
	}	
        /**
         * Function get firstname by user_id
         * @param type $mysqli - Mysqli connection
         * @param type $uid - User id from DB
         * @return String
         */
        function get_vards_from_id($mysqli, $uid){
		
		$sql = "
		SELECT name FROM peoples
		WHERE id =$uid
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
		{$vards =$data[0];}
		 return $vards;
	}



}
?>