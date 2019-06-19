<?php

class questions {

   
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function questions() {
       
    }
    
    function select_names( $mysqli ){
    $options = '';
    $result = $mysqli->query("SELECT id,name FROM questionnaire WHERE active =1 ORDER BY id DESC");
    while($showtablerow = mysqli_fetch_array($result))
	{
		$options.='<option value="'. $showtablerow[0].'">'. $showtablerow[1].'</option>';
	}
        return $options;
    }	
    function count_steps($mysqli, $test_id){
		$result	= $mysqli->query("SELECT MAX( q.order ) FROM questions q INNER JOIN answers a ON a.q_id = q.id WHERE q.name_id =$test_id");
		while($count = mysqli_fetch_array($result))
		{$steps =$count[0];}
		 return $steps;
    }
    
    function count_steps_from_uid($mysqli, $user_id){
		$result	= $mysqli->query("SELECT MAX( q.order ) FROM questions q INNER JOIN answers a ON a.q_id = q.id WHERE q.name_id =(SELECT form_id from peoples WHERE id=$user_id)");
		while($count = mysqli_fetch_array($result))
		{$steps =$count[0];}
		 return $steps;
    }
    
    
    function question_name($mysqli, $name, $id){
		$sql = "
		SELECT q.questions
		FROM questions q
		WHERE q.name_id =$name
		AND q.order =$id
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
                {$nos =$data[0];}
		if($nos){ return $nos;}
		
	}
        
    	function question_answers($mysqli, $name, $id){
		$sql = "
		SELECT a.id, a.answer FROM questions q
				INNER JOIN answers a ON a.q_id = q.id
				WHERE q.name_id = $name
				AND q.order = $id
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
        function get_correct_answers($mysqli, $id){
		
		$sql = "
		SELECT count(*) FROM peoples p
		INNER JOIN people_answ an on p.id = an.people_id
		INNER JOIN answers a on a.id = an.answer_id
		WHERE p.id=$id and a.correct=1
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
		{$skaits =$data[0];}
		 mysqli_free_result($result);
		 if($skaits){ return $skaits;}else{return 0;}
		
	}	
        
        function get_vards_from_id($mysqli, $id){
		
		$sql = "
		SELECT name FROM peoples
		WHERE id =$id
		";
		$result	= $mysqli->query($sql);
		while($data = mysqli_fetch_array($result))
		{$vards =$data[0];}
		 return $vards;
	}



}
?>