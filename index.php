<?php session_start();
    include "/class/db.php";
    $db = db::getInstance();
    $mysqli = $db->getConnection();
    include "/class/questions.php";
    $questions = new questions();
?>

<!DOCTYPE HTML>
<html lang="lv">
	<head>
		<title>Anketa</title>
		<meta name="description" content="HTML testa uzdevums">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
		<!--Pieslēdzam Skriptus -->
		<script src="/assets/js/check.js" type="text/javascript"></script> <!--form check -->
	</head>
	<body>
		<div class="square" style="display:block"> <!--main start -->
			<div class="content_center"> <!--center main start -->
			<p class="no_margin">Testa uzdevums</p>
			<form name="form1" action="questions.php" method="POST" onsubmit="return validatename()">
				<input type="text" name="firstname" required size="50" placeholder="Ievadi savu vārdu" value=""><br>
				<p class="no_margin"><select size="1" name="tests">
					<option value="0" selected disabled>Izvēlies testu:</option>
					<?php echo $questions->select_names( $mysqli); ?> <!--auto show active TESTS -->
					</select></p>
				<input type="submit" value="Sākt">
				<input type="hidden" name="datums" value="<?php echo today();?>" />
			</form>
			</div>	<!--center main end -->
		</div>	<!--main Beigas -->
	
	</body>
</html>