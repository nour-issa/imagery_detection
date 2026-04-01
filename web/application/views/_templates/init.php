<?php
    ob_start();
    session_start();
    try{
    //  *************** Connect to PostgreSQL
    $dsn = 'pgsql:host=localhost;dbname=test;port=5432;';
    $pdo = new PDO($dsn, 'postgres', '123123');}
    catch(PDOException $e){
        echo "Error: {$e}";}
?>
