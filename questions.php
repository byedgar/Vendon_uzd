<?php
session_start();
include "/class/db.php";
$db = db::getInstance();
$mysqli = $db->getConnection();
include "/class/questions.php";
$questions = new questions();

print_r($_POST);
if(isset($_POST['firstname']))    
    $firstname=$_POST['firstname']; 
if(isset($_POST['tests']))   
    $test_id=$_POST['tests']; 
if(isset($_POST['datums']))   
    $datums=$_POST['datums']; // Get start datetime
if(isset($_POST['atbilde']))  
    $answer_id=$_POST['atbilde'];

$steps= $questions->count_steps($mysqli, $test_id); // Counting all questions by form_id

IF($_SESSION["uid"] >0){ $user_id=$_SESSION["uid"];} //Getting user_id from Session

$prev=0; // Initializing first question for Javascript Step function
if(isset($_POST['jautajums'])) 
{
    $jautajums = $_POST['jautajums'];
    $jautajums++;
    $sql = "INSERT INTO people_answ (people_id,answer_id) VALUES ('$user_id', '$answer_id')";
    $result = $mysqli->query($sql);
    $prev=$jautajums-1;
}
else {
    $jautajums = 1;
    $sql = "INSERT INTO peoples (form_id,name,start) VALUES ('$test_id','$firstname', '$datums')";
    $result = $mysqli->query($sql);
    $user_id=mysqli_insert_id($mysqli);
    $_SESSION["uid"]=$user_id;			
}
    echo $jautajums . " " . $steps;
if ($steps==$jautajums)
    $button="Apskatīt rezultātus";
else
$button="Nākamais";

if($jautajums > $steps){
    $sql = "UPDATE peoples SET finish=NOW() WHERE id= $user_id";
    $result = $mysqli->query($sql);
    header("Location: check.php");
    die();  
}
?>
<!DOCTYPE HTML>
<html lang="lv">
	<head>
		<title>Jautājumi</title>
		<meta name="description" content="HTML testa uzdevums">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css"/>	
		<script src="/assets/js/check.js" type="text/javascript"></script>		
	</head>
	<body>	
	
			<div class="square" style="display:block"> 
			<div class="content_center"><b> 
		<?php echo $questions->question_name($mysqli, $test_id, $jautajums); ?></b><hr> <!-- Get Question name from DB by form_id and question ID -->
		<form id="form2" method="post" action="questions.php">
			<ul class="atbildes">
			<?php echo $questions->question_answers($mysqli, $test_id, $jautajums); ?> <!-- Get Question answers from DB by form_id and question ID -->
			</ul>
	      <input type="submit" value="<?php echo $button; ?>" />
	      <input type="hidden" name="jautajums" value="<?php echo $jautajums; ?>" /> 
		  <input type="hidden" name="datums" value="<?php echo $datums;?>" />
		  <input type="hidden" name="firstname" value="<?php echo $firstname;?>" />
		  <input type="hidden" name="tests" value="<?php echo $test_id;?>" />
		</form>
			<div style="text-align:center">
			<?php
			if($steps>0){
			for( $z= 1 ; $z <= $steps ; $z++ ){echo '<span class="step"></span>';} //Get list of all questions 
			}
			?>
			</div>
		</div>
		</div>

	
	<script src="/assets/js/quest.js" type="text/javascript"></script> <!-- connecting step script -->
		<?php
		if($prev OR $prev==0){
			echo '<script type="text/javascript">',
				'fixStepIndicator('.$prev.');',
				'</script>';
		}

	
	?>
	</body>
</html>