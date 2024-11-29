<?php
function getMinimumPenalty($x, $y, $diffmmpen, $pgap, $samemmpen) {
    $i; $j;
     
    $m = strlen($x); // length of word 1
    $n = strlen($y); // length of word 2
     
    // table for storing optimal
    // substructure answers
    $matrix = array_fill(0, $m + 1, array_fill(0, $n + 1, 0));
 
    // initialising 
    for ($i = 0; $i <= $m; $i++) $matrix[$i][0] = $i * $pgap;
    for ($j = 0; $j <= $n; $j++) $matrix[0][$j] = $j * $pgap;
 
    // calculating the 
    // minimum penalty
    // O(m * n)
    for ($i = 1; $i <= $m; $i++)
    {
        for ($j = 1; $j <= $n; $j++)
        {
            // if the same
            if ($x[$i - 1] == $y[$j - 1])
            {
                // echo $x[$i-1] . ' is the same as ' . $y[$j - 1] . '<br>';
                $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
            }
            // if of same type, use same penalty
            else if(sameType($x[$i-1], $y[$j-1]))
            {
                // echo $y[$j-1] . '<br>';
                // echo sameType($x[$i-1], $y[$j-1]) . $x[$i-1] . ' == ' . $y[$j-1] . '<br>';
                $matrix[$i][$j] = min($matrix[$i - 1][$j - 1] + $samemmpen,
                                  $matrix[$i - 1][$j] + $pgap , 
                                  $matrix[$i][$j - 1] + $pgap );
            }
            // different type, use different penalty (vowel/consonant)
            else
            {
                // echo $x[$i-1] . ' == ' . $y[$j-1] . '<br>';
                $matrix[$i][$j] = min($matrix[$i - 1][$j - 1] + $diffmmpen , 
                                  $matrix[$i - 1][$j] + $pgap , 
                                  $matrix[$i][$j - 1] + $pgap );
            }
        }
    }
    return $matrix[$m][$n];
}

// checks if its a vowel, consonant, or neither
function isVowel($letter) {
    // Convert the letter to lowercase for uniformity
    $letter = strtolower($letter);
    
    $vowels = 'aeiou';

    $consonants = 'bcdfghjklmnpqrstvwxyz';
    
    // Check if the letter is in the set of vowels
    if (strpos($vowels, $letter) !== false) {
        return 1;
    } else if (strpos($consonants, $letter) !== false){
        return 0;
    } else {
        return 2;
    }
}
// compares two letters using isVowel
function sameType($letter1, $letter2) {
    if (isVowel($letter1) == (isVowel($letter2))) {
        return true;
    } else {
        return false;
    }
}

$gapPenalty = 2;
$sameTypeMisMatchPenalty = 1;
$nonSameTypeMisMatchPenalty = 3;
