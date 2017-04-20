<?php
$sub = 'Aaaa bbb aaa ccc aAa bBB';

echo 'Analisys of "'. $sub .'"<br />';

$numOfMatch;

preg_replace_callback_array(
    [
        '~a+~i' => function($match) { echo $match[0] . "match found for a <br />"; var_dump($match); },
        '~b+~i' => function($match) { echo $match[0] . "match found for b <br />"; },
    ],
    $sub,
    -1,
    $numOfMatch
);

echo $numOfMatch;