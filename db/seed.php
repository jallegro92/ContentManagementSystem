<?php
$fp = fopen('seed.sql', 'r');
while(!feof($fp)){
    $line = rtrim(fgets($fp));
    if ($line != ''){
        $pdo->query($line)or die(print_r($pdo->errorInfo(), true));
    }
}
