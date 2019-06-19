<?php
session_start();
/**
 * Connecting DB class
 */
include "/class/db.php";
$db = db::getInstance();
$mysqli = $db->getConnection();

/**
 * Connecting question class
 */
include "/class/questions.php";
$questions = new questions();

/**
 * Checking session
 */
IF ($_SESSION["uid"] > 0) {
    $user_id = $_SESSION["uid"];
} else {
    header("Location: index.php");
    die();
} 

$steps = $questions->count_steps_from_uid($mysqli, $user_id); // Getting all question count
$firstname = $questions->get_vards_from_id($mysqli, $user_id); // Getting firstname by user_id
$zina = '';
$correct_answers = $questions->get_correct_answers($mysqli, $user_id); //Getting correct questions from DB by user_id
$zina = "<h1>Paldies, " . $firstname . "!</h1>";
$zina.="<p>Tu atbildēji pareizi uz " . $correct_answers . "  no " . $steps . " jautājumiem.</p>";
$zina.="<p><a href=\"index.php\" target = \"_self\">Uz sākumu</a></p>";
?>

<!DOCTYPE HTML>
<html lang="lv">
    <head>
        <title>Rezultāts</title>
        <meta name="description" content="HTML testa uzdevums">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="/assets/css/main.css" />
    </head>
    <body>
        <div class="square" style="display:block"> 
            <div class="content_center"> 
                <?php IF ($zina) {
                    echo $zina;
                } ?>
            </div>
        </div>
    </body>
</html>