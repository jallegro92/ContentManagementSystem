<?php
if (!$settings = parse_ini_file('dbSettings.ini', TRUE)) throw new exception('Unable to open dbSettings.ini.');
$user = $settings['setup']['user'];
$host = $settings['database']['host'];
try{
    $pdo = new PDO("mysql:host=$host;", "$user");
    $fp = fopen('setup.sql', 'r');
    while(!feof($fp)){
        $line = rtrim(fgets($fp));
        if ($line != ''){
            $pdo->query($line)or die(print_r($pdo->errorInfo(), true));
        }
    }
    require 'seed.php';
}catch(PDOException $e) {
    echo "ERROR!: " . $e->getMessage();
}
