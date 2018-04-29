<?php
// mysql://bd152829e29d21:f75d67d5@us-cdbr-iron-east-05.cleardb.net/heroku_3c6c55000c1ac8a?reconnect=true
function connectToDB($dbName) {
    $host = 'us-cdbr-iron-east-05.cleardb.net';
    $db   =  $dbName;
    $user = 'bd152829e29d21';
    $pass = 'f75d67d5';
    $charset = 'utf8mb4';
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo; 
}
?>