<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <head>
        <title>Spellchecker</title>
</head>
<body class="w3-center w3-monospace">
    <h1 class="w3-teal w3-center w3-monospace"> Spell Checker </h1>
    <form action='' method='POST'>
    <label for='name'>Enter a word: </label> <br>
    <input class="w3-section" type='text' name='word' id='word' placeholder='Your word here...'>
    <br>
    <h4><input class="w3-monospace"type='submit' value='Check'></h4>
    </form>
</body>
</html>

<?php 
require './340p4.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<h4>' . 'Suggestions' . '</h4>';
    $dictOfWords = array();
    $fileRead = fopen("dictionary.txt", "r");
    while (($line = fgets($fileRead)) !== false) {
        $line = trim($line); // i spent 3 hours looking for this error. there was whitespace that added extra gaps making everything wrong.
        $dictOfWords[$line] = getMinimumPenalty($_POST['word'], $line, $nonSameTypeMisMatchPenalty, $gapPenalty, $sameTypeMisMatchPenalty);
    }
    
    asort($dictOfWords);
    $i = 0;
    foreach($dictOfWords as $key => $value) {
        // change this to be more than top 10 words!
        if ($i < 10) {
            echo $key . '<br>';
            $i = $i + 1;
        }
        else {
            break;
        }
    }
}
?>